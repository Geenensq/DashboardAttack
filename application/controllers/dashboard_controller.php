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
    	echo json_encode($earnings);
    }




}
 ?>