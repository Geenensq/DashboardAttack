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
    private $qte_product;

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
        $this->load->model('Orders_model', 'modelOrders');
        $this->load->model('Product_order_model', 'modelProductOrder');
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
// !                               Method for add an order                                   //
// ==========================================================================================//
    public function addOrders()
    {
        $this->form_validation->set_rules('customer_order', '"customer_order"', 'required');
        $this->form_validation->set_rules('date_order', '"date_order"', 'required');
        $this->form_validation->set_rules('state_order', '"state_order"', 'required');
        $this->form_validation->set_rules('shipping_order', '"shipping_order"', 'required');
        $this->form_validation->set_rules('payments_order', '"payments_order"', 'required');
        $this->form_validation->set_rules('comment_order', '"comment_order"', 'required');

        $callBack = array();

        if ($this->form_validation->run()) {

            /************** Receipt of data posted by javascript ***********************/
            $this->id_customer = $this->input->post('customer_order');
            $this->date_order = $this->input->post('date_order');
            $this->status_order = $this->input->post('state_order');
            $this->comment_order = $this->input->post('comment_order');

            /*For the moment we define the price of the order to 0
            we attribute to him the final price at the end of the treatment*/
            $this->price_order = 0;
            $this->id_method_payment = $this->input->post('payments_order');
            $this->id_method_shipping = $this->input->post('shipping_order');
            /************************************************************************/

            /******************************Create my object orders********************************/
            $this->modelOrders->setIdCustomer($this->id_customer);
            $this->modelOrders->setDateOrder($this->date_order);
            $this->modelOrders->setStatusOrder($this->status_order);
            $this->modelOrders->setCommentOrder($this->comment_order);
            $this->modelOrders->setPriceOrder($this->price_order);
            $this->modelOrders->setIdMethodPayment($this->id_method_payment);
            $this->modelOrders->setIdMethodShipping($this->id_method_shipping);
            /************************************************************************************/

            $modelOrders = $this->modelOrders;
            $id_order = $this->modelOrders->insertOneOrder($modelOrders);

            $callBack["confirm"] = "success";
            $callBack["id_order"] = $id_order;

        } else {
            $callBack["confirm"] = "error";
        }

        echo json_encode($callBack);
        
    }
// =======================================================================//
// !                     INSERT ONE PRODUCT ORDER                        //
// ======================================================================//

     public function addProductOrder()
     {
        $this->id_product = $this->input->post('id_product_order');
        $this->qte_product = $this->input->post('quantity_product_order');
        $this->id_order = $this->input->post('id_order');

        $this->modelProductOrder->setIdProduct($this->id_product);
        $this->modelProductOrder->setQuantityProduct($this->qte_product);
        $this->modelProductOrder->setIdOrder($this->id_order);

        $modelProductOrder = $this->modelProductOrder;
        $this->modelProductOrder->inserOneProductOrder($modelProductOrder);
        
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