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
        $this->load->model('Products_orders_model', 'modelProductsOrders');
    }

// =======================================================================//
// !                         Default method                              //
// ======================================================================//
    public function index()
    {	
        if($this->session->userdata('id_member')){
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
        }else{
            redirect(array('login_controller', 'index'));
        }
       
    }

// =======================================================================//
// !                    autocompletion customers                         //
// ======================================================================//

    public function getCustomersAutoComplete(){

        $search = $this->input->get('q', FALSE);
        $results = $this->modelCustomers->selectALLAutoComplete($search);

        echo json_encode($results);
    }


// =======================================================================//
// !                     autocompletion products                         //
// ======================================================================//

    public function getProductsAutoComplete(){

        $search = $this->input->get('q', FALSE);
        $results = $this->modelProducts->selectALLAutoComplete($search);

        echo json_encode($results);

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



// ==========================================================================================//
// !                      Method get all informations of an order                            //
// ==========================================================================================//

    public function getInfosOrdersForEdit()
    {
        $this->id_order = $this->input->post('id');
        $return = $this->modelOrders->selectAllOrders($this->id_order);
        echo json_encode($return);
    }


// ==========================================================================================//
// !                Method get all informations of product order                             //
// ==========================================================================================//

    public function getInfosProductsOrdersForEdit()
    {
        $this->id_order = $this->input->post('id');
        $return = $this->modelProductsOrders->selectAllProductsOrders($this->id_order);
        echo json_encode($return);
    }



// =======================================================================//
// !                Method for send orders on datatable                  //
// ======================================================================//

    public function encodeGridOrders()
    {
        $results = $this->modelOrders->loadDataOrdersDataTable();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_order'], $result['date_order'], $result['comment_order'], $result['price_order'], $result['firstname'], $result['lastname'], $result['method_payment'], $result['method_shipping'], $result['name_state']);
        }

        echo json_encode(array('data' => $data));
    }


// =======================================================================//
// !                  Method for EDIT AN GROUPS OF PRODUCTS               //
// ======================================================================//

    public function changeInfosOrders()
    {
        $this->form_validation->set_rules('id_order', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_customer_order', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_date_order', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_price_order', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_comment_order', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_method_payment', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('shipping_order', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_state_order', '" "', 'required|min_length[1]');
        
        $callBack = array();

        if ($this->form_validation->run()) {

            $this->modelOrders->setIdOrder($this->input->post('id_order'));
            $this->modelOrders->setIdCustomer($this->input->post('new_customer_order'));
            $this->modelOrders->setDateOrder($this->input->post('new_date_order'));
            $this->modelOrders->setPriceOrder($this->input->post('new_price_order'));
            $this->modelOrders->setCommentOrder($this->input->post('new_comment_order'));
            $this->modelOrders->setIdMethodPayment($this->input->post('new_method_payment'));
            $this->modelOrders->setIdMethodShipping($this->input->post('shipping_order'));
            $this->modelOrders->setStatusOrder($this->input->post('new_state_order'));

            $order = $this->modelOrders;

            $this->modelOrders->updateOrder($order);
            $callBack["confirm"] = "success";

        } else {

            $callBack["errorNewNameGroup"] = "error";
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
        $this->modelProductsOrders->setIdProduct($this->id_product);
        $this->modelProductsOrders->setQuantityProduct($this->qte_product);
        $this->modelProductsOrders->setIdOrder($this->id_order);

        $modelProductsOrders = $this->modelProductsOrders;
        $this->modelProductsOrders->insertOneProductOrder($modelProductsOrders);
        $callBack["confirm"] = "success";
        echo json_encode($callBack);
        
    }

// ==========================================================================================//
// !                       Method to remove a product from a order                           //
// ==========================================================================================//
    public function removeProductOrder()
    {
        $this->id_order = $this->input->post('id_order');
        $this->id_product = $this->input->post('id_product');

        $this->modelProductsOrders->setIdOrder($this->id_order);
        $this->modelProductsOrders->setIdProduct($this->id_product);
        $modelProductsOrders = $this->modelProductsOrders;
        $this->modelProductsOrders->deleteProductOrder($modelProductsOrders);
        $callback["confirm"] = "success";
        echo json_encode($callback);
    }
    
// ==========================================================================================//
// !                        Method to UPDATE the price of an order                           //
// ==========================================================================================//
    public function editPriceOrder()
    {
        $this->id_order = $this->input->post('id_order');
        $this->price_order = $this->input->post('price');

        $this->modelOrders->setIdOrder($this->id_order);
        $this->modelOrders->setPriceOrder($this->price_order);
        $modelOrders = $this->modelOrders;
        $this->modelOrders->updatePriceOrder($modelOrders);
        $callback["confirm"] = "success";
        echo json_encode($callback);
    }

// ==========================================================================================//
// !              Method to find out if a product is already in a order                      //
// ==========================================================================================//

    public function checkProductInOrder()
    {
        $this->id_order = $this->input->post('id_order');
        $this->id_product = $this->input->post('id_product_check');

        $this->modelProductsOrders->setIdOrder($this->id_order);
        $this->modelProductsOrders->setIdProduct($this->id_product);
        $modelProductsOrders = $this->modelProductsOrders;
        
        $return = $this->modelProductsOrders->selectCheckProductInOrder($modelProductsOrders);

        echo json_encode($return);
    }

// ==========================================================================================//
// !                 method to update the number of the product in the order                 //
// ==========================================================================================//

    public function EditQuantityProduct()
    {
        $this->id_order = $this->input->post('id_order');
        $this->id_product = $this->input->post('id_product');
        $this->qte_product = $this->input->post('new_quantity');

        $this->modelProductsOrders->setIdOrder($this->id_order);
        $this->modelProductsOrders->setIdProduct($this->id_product);
        $this->modelProductsOrders->setQuantityProduct($this->qte_product);
        $modelProductsOrders = $this->modelProductsOrders;
        
        $this->modelProductsOrders->updateQuantityProduct($modelProductsOrders);
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