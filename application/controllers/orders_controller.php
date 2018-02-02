<?php
/**
 * Dashboard Attack, command manager
 * orders_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

Class Orders_controller extends CI_Controller
{
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
	private $id_order;
	private $date_order;
	private $status_order;
	private $comment_order;
	private $price_order;
	private $id_customer;
	private $id_method_payment;
	private $id_method_shipping;

    private $id_product;

// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customers_model', 'modelCustomers');
        $this->load->model('States_model', 'modelStates');
        $this->load->model('Shipping_model', 'modelShipping');
        $this->load->model('Payments_model', 'modelPayments');
        $this->load->model('Products_model', 'modelProducts');

    }

// =======================================================================//
// !                         Default method                              //
// ======================================================================//
    public function index()
    {	
        $customers = $this->modelCustomers->selectAll();
        $states = $this->modelStates->selectAll();
        $shipping = $this->modelShipping->selectAll();
        $payments = $this->modelPayments->selectAll();
        $products = $this->modelProducts->selectAll();

        $array = [];
        
        $array['customers'] = $customers;
        $array['states'] = $states;
        $array['shipping'] = $shipping;
        $array['payments'] = $payments;
        $array['products'] = $products;

    
        $this->load->view('dashboard/orders.html', $array);
    }


// ==========================================================================================//
// !               Method get all informations of products for my array                      //
// ==========================================================================================//

    public function getInfosProductsArray()
    {
        $this->id_product = $this->input->post('id');
        $return = $this->modelProducts->selectAllProductsForModal($this->id_product);
        echo json_encode($return);
    }


}