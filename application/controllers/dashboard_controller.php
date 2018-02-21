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

/*      IMPROVMENT:
        Faire une fonction externe qui transforme un nombre en mois , exemple 1 -> janvier 
        Faire une fonction externe qui transforme un mois en nombre , exemple janvier -> 1
        TODO : 
        Transformer $i en mois exemple : $i = 1 => janvier;

*/

        for ($i=1; $i <= 12; $i++){
            foreach ($earnings as $key => $month){
                //$month['month' , 'years' , 'total_order' , 'how_much_order']/
                $monthNumber = $i;
                $yearNumber = $month['years'];

                if ($month['month'] == $i){
                    //le mois est egale a i, donc c'est qu'il y'avait des resultat, on pousse le resultat a l'index de $i
                    $completeResult[$yearNumber][$i] = $month;

                } else {
                    //sinon on push un nouveaux resultat
                    $newResult = array('month'=> $i, 'years' => $month['years'],'total_order' => 0, 'how_much_order' => 0);

                    $completeResult[$yearNumber][$i] = $newResult;
          
                }
            }
        }

        debug($completeResult);
    	echo json_encode($completeResult);
    }




}
 ?>