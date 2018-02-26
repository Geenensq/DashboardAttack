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

//----Attributes messages----//
    private $id_message;
    private $text_message;
    private $date_message;
    private $id_member;

// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Orders_model', 'modelOrders');
        $this->load->model('Messages_model', 'modelMessages');
        $this->id_member = $this->session->userdata('id_member');
    }

// =======================================================================//
// !                         Default method                              //
// ======================================================================//

    public function index()
    {
        $id_member = $this->id_member;
        $this->load->view('dashboard/dashboard.html' , array('id_member' => $id_member));	
    }

// =======================================================================//
// !              Method for display selected messages on chat           //
// ======================================================================//
    public function getMessages(){
        $messages = $this->modelMessages->selectMessagesTchat();
        echo json_encode($messages);
    }

// =======================================================================//
// !                   Method for send an messages on chat               //
// ======================================================================//
    public function sendMessages(){
        
        $this->form_validation->set_rules('text_message' , '"text_message"' , 'required');
        $this->form_validation->set_rules('id_member' , '"id_member"' , 'required');

        $callBack = array();

        if($this->form_validation->run()){
            $this->modelMessages->setIdMember($this->input->post('id_member'));
            $this->modelMessages->setTextMessage($this->input->post('text_message'));
            $messagesModel = $this->modelMessages;
            $this->modelMessages->insertOneMessage($messagesModel);
             $callBack["confirm"] = "success";
        } else {
            $callBack["confirm"] = "error";
        }
            echo json_encode($callBack);

    }


// =======================================================================//
// !          Method for send orders details in dashboard datatable      //
// ======================================================================//

    public function encodeGridLastOrders()
    {
        $orders = $this->modelOrders->lastOrders();
        $data = array();

        foreach ($orders as $result) {
            $data[] = array($result['id_order'], $result['name_state'], $result['firstname'] , $result['lastname']);
        }

        echo json_encode(array('data' => $data));
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