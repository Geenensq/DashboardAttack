<?php
/**
 * Dashboard Attack, command manager
 * dashboard_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */


Class Dashboard_controller extends CI_Controller
{

// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Orders_model', 'modelOrders');
    }

// =======================================================================//
// !                         Default method                              //
// ======================================================================//

    public function index()
    {
    	$orders = $this->modelOrders->lastOrders();
    	$array = [];
    	$array['orders'] = $orders;
        $this->load->view('dashboard/dashboard.html' , $array);	
    }
// =======================================================================//
// !                Method for stats of status orders                    //
// ======================================================================//

    public function getStatusOrders()
    {
    	$resultStats = $this->modelOrders->OrdersStatusStats();
     
        if(count($resultStats) == 0){
            for ($i=0; $i == 6; $i++){
                $resultStats[$i] = array("how_much"=> 0, "id_state" =>$i,"name_state" => 0);
            }
        }

    	echo json_encode($resultStats);
    }


// =======================================================================//
// !                Method for stats earnings by months                  //
// ======================================================================//
 public function getEarnings()
    {
        $earnings = $this->modelOrders->selectEarningsByMonths();
        //declare un array vide qui combleras les trous
        $completeResult = array();


       if(count($earnings) == 0){
            for ($i=1; $i <= 12; $i++){
                $earnings[$i] = array('month'=> $i, 'years' =>2018,'total_order' => 0, 'how_much_order' => 0);
            }
        }

        $aOfYears= [];

        foreach ($earnings as $month) {
            $aOfYears[$month['years']] = 1;
        }

        foreach ($aOfYears as $key => $value){
            for ($i=1; $i <= 12; $i++){
                $completeResult[$key][$i-1] = array('month'=> $i, 'years' => $key,'total_order' => 0, 'how_much_order' => 0);
            }
        }
            foreach ($earnings as $key => $month){
                
                $monthNumber = $i;
                $yearNumber = $month['years'];
                
                //le mois est egale a i, donc c'est qu'il y'avait des resultat, on pousse le resultat a l'index de $i
                $newResult = array('month'=> $month['month'], 'years' => $month['years'],'total_order' => $month['total_order'], 'how_much_order' => $month['how_much_order']);          
                $completeResult[$yearNumber][$month['month']-1] = $newResult;
            }
        echo json_encode($completeResult);
    }





}
 ?>