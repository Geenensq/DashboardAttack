<?php
/**
 * Dashboard Attack, command manager
 * orders_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

class Orders_controller extends CI_Controller
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
    private $id_size;
    private $id_color;
    private $id_meaning;

    // =======================================================================//
    // !                  Constructor of my Class                            //
    // ======================================================================//
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf');
        $this->load->helper('file');
        $this->load->model('Customers_model', 'modelCustomers');
        $this->load->model('States_model', 'modelStates');
        $this->load->model('Shipping_model', 'modelShipping');
        $this->load->model('Payments_model', 'modelPayments');
        $this->load->model('Products_model', 'modelProducts');
        $this->load->model('Orders_model', 'modelOrders');
        $this->load->model('Products_orders_model', 'modelProductsOrders');
        $this->load->model('Groups_colors_model', 'modelGroupsColors');
        $this->load->model('Groups_sizes_model', 'modelGroupSizes');
        $this->load->model('Products_sizes_model', 'modelProductsSizes');
        $this->load->model('Products_colors_model', 'modelProductsColors');
        $this->load->model('Meanings_model', 'modelMeanings');
        $this->load->model('Products_meanings_model', 'modelProductsMeanings');
    }

    // =======================================================================//
    // !                         Default method                              //
    // ======================================================================//
    public function index()
    {
        if ($this->session->userdata('id_member')) {

            $customers = $this->modelCustomers->selectAll();
            $states = $this->modelStates->selectAll();
            $shipping = $this->modelShipping->selectAll();
            $payments = $this->modelPayments->selectAll();
            $groupsColors = $this->modelGroupsColors->selectAll();
            $groupsSizes = $this->modelGroupSizes->selectAll();
            $meanings = $this->modelMeanings->selectAll();

            $array = [];
            $array['customers'] = $customers;
            $array['states'] = $states;
            $array['shipping'] = $shipping;
            $array['payments'] = $payments;
            $array['groupsColors'] = $groupsColors;
            $array['groupsSizes'] = $groupsSizes;
            $array['meanings'] = $meanings;

            $this->load->view('dashboard/orders.html', $array);
        } else {
            redirect(array('login_controller', 'index'));
        }

    }

    // =======================================================================//
    // !                    Autocompletion customers                         //
    // ======================================================================//

    public function getCustomersAutoComplete()
    {

        $search = $this->input->get('q', false);
        $results = $this->modelCustomers->selectAllCustomersAutoComplete($search);

        echo json_encode($results);
    }

    // =======================================================================//
    // !            Method for get the price of shipping method               //
    // ======================================================================//
    public function getShippingsInfos()
    {
        $this->id_method_shipping = $this->input->post('id');
        $this->modelShipping->setIdMethodShipping($this->id_method_shipping);
        $modelShipping = $this->modelShipping;
        $infosMethodShipping = $this->modelShipping->selectShippingsInfos($modelShipping);

        echo json_encode($infosMethodShipping);
    }

    // =======================================================================//
    // !         Method for get the price of shipping of the order            //
    // ======================================================================//
    public function getShippingsPriceOrders()
    {
        $this->id_order = $this->input->post('id');
        $this->modelOrders->setIdOrder($this->id_order);
        $modelOrders = $this->modelOrders;

        $infosPriceShipping = $this->modelOrders->selectPriceShippingOrders($modelOrders);

        echo json_encode($infosPriceShipping);
    }

    // =======================================================================//
    // !                  Method to change the delivery method                //
    // ======================================================================//
    public function changeShippingsMethod()
    {
        $this->id_order = $this->input->post('id_order');
        $this->id_method_shipping = $this->input->post('id_method_shipping');

        $this->modelOrders->setIdOrder($this->id_order);
        $this->modelOrders->setIdMethodShipping($this->id_method_shipping);
        $modelOrders = $this->modelOrders;
        $this->modelOrders->updateShippingOrder($modelOrders);
    }

    // =======================================================================//
    // !                     Autocompletion products                         //
    // ======================================================================//

    public function getProductsAutoComplete()
    {
        $search = $this->input->get('q', false);
        $results = $this->modelProducts->selectAllProductsAutoComplete($search);
        echo json_encode($results);
    }

    // =======================================================================//
    // !                     Function for delete an order                    //
    // ======================================================================//
    public function removeOrders()
    {
        $this->id_order = $this->input->post('id');

        /********************Firts delete products of my orders***********************/
        $this->modelProductsOrders->setIdOrder($this->id_order);
        $modelProductsOrders = $this->modelProductsOrders;
        $this->modelProductsOrders->deleteProcuctsOrder($modelProductsOrders);
        /*****************************************************************************/

        /*****************************Delete orders**********************************/
        $this->modelOrders->setIdOrder($this->id_order);
        $modelOrders = $this->modelOrders;
        $this->modelOrders->deleteOrders($modelOrders);
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

            $this->modelOrders->updateOneOrder($order);
            $callBack["confirm"] = "success";

        } else {

            $callBack["errorNewNameGroup"] = "error";
        }

        echo json_encode($callBack);
    }

    // =======================================================================//
    // !                     INSERT ONE PRODUCT ORDER                        //
    // ======================================================================//

    public function addProductsOrders()
    {
        $this->id_product = $this->input->post('id_product_order');
        $this->qte_product = $this->input->post('quantity_product_order');
        $this->id_order = $this->input->post('id_order');
        $this->id_size = $this->input->post('id_size');
        $this->id_color = $this->input->post('id_color');
        $this->id_meaning = $this->input->post('id_meaning');

        $this->modelProductsOrders->setIdProduct($this->id_product);
        $this->modelProductsOrders->setQuantityProduct($this->qte_product);
        $this->modelProductsOrders->setIdOrder($this->id_order);
        $this->modelProductsOrders->setIdMeaning($this->id_meaning);
        $this->modelProductsOrders->setIdSize($this->id_size);
        $this->modelProductsOrders->setIdColor($this->id_color);

        $modelProductsOrders = $this->modelProductsOrders;
        $this->modelProductsOrders->insertOneProductOrder($modelProductsOrders);
        $callBack["confirm"] = "success";
        echo json_encode($callBack);

    }

    // ==========================================================================================//
    // !                       Method to remove a product from a order                           //
    // ==========================================================================================//
    public function removeProductsOrders()
    {
        $this->id_order = $this->input->post('id_order');
        $this->id_product = $this->input->post('id_product');
        $this->id_size = $this->input->post('id_size');
        $this->id_color = $this->input->post('id_color');
        $this->id_meaning = $this->input->post('id_meaning');

        $this->modelProductsOrders->setIdOrder($this->id_order);
        $this->modelProductsOrders->setIdProduct($this->id_product);
        $this->modelProductsOrders->setIdSize($this->id_size);
        $this->modelProductsOrders->setIdColor($this->id_color);
        $this->modelProductsOrders->setIdMeaning($this->id_meaning);

        $modelProductsOrders = $this->modelProductsOrders;
        $this->modelProductsOrders->deleteProductOrder($modelProductsOrders);
        $callback["confirm"] = "success";
        echo json_encode($callback);
    }

    // ==========================================================================================//
    // !                        Method to UPDATE the price of an order                           //
    // ==========================================================================================//
    public function editPriceOrders()
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

    public function checkProductInOrders()
    {
        $this->id_order = $this->input->post('id_order');
        $this->id_product = $this->input->post('id_product_check');
        $this->id_size = $this->input->post('id_size');
        $this->id_color = $this->input->post('id_color');
        $this->id_meaning = $this->input->post('id_meaning');

        $this->modelProductsOrders->setIdOrder($this->id_order);
        $this->modelProductsOrders->setIdProduct($this->id_product);
        $this->modelProductsOrders->setIdColor($this->id_color);
        $this->modelProductsOrders->setIdSize($this->id_size);
        $this->modelProductsOrders->setIdMeaning($this->id_meaning);

        $modelProductsOrders = $this->modelProductsOrders;

        $return = $this->modelProductsOrders->selectCheckProductInOrder($modelProductsOrders);

        echo json_encode($return);
    }

    // ==========================================================================================//
    // !                 method to update the number of the product in the order                 //
    // ==========================================================================================//

    public function EditQuantityProducts()
    {
        $this->id_order = $this->input->post('id_order');
        $this->id_product = $this->input->post('id_product');
        $this->qte_product = $this->input->post('new_quantity');
        $this->id_size = $this->input->post('id_size');
        $this->id_color = $this->input->post('id_color');
        $this->id_meaning = $this->input->post('id_meaning');

        $this->modelProductsOrders->setIdOrder($this->id_order);
        $this->modelProductsOrders->setIdProduct($this->id_product);
        $this->modelProductsOrders->setQuantityProduct($this->qte_product);
        $this->modelProductsOrders->setIdSize($this->id_size);
        $this->modelProductsOrders->setIdColor($this->id_color);
        $this->modelProductsOrders->setIdMeaning($this->id_meaning);
        $modelProductsOrders = $this->modelProductsOrders;
        $this->modelProductsOrders->updateQuantityProduct($modelProductsOrders);
    }

    // ==========================================================================================//
    // !               Method get all informations of products for my array                      //
    // ==========================================================================================//

    public function getInfosProductsArray()
    {
        $this->id_product = $this->input->post('id_product');
        $this->id_size = $this->input->post('id_size');
        $this->id_order = $this->input->post('id_order');
        $this->id_color = $this->input->post('id_color');
        $this->id_meaning = $this->input->post('id_meaning');

        $this->modelProductsOrders->setIdOrder($this->id_order);
        $this->modelProductsOrders->setIdSize($this->id_size);
        $this->modelProductsOrders->setIdProduct($this->id_product);
        $this->modelProductsOrders->setIdColor($this->id_color);
        $this->modelProductsOrders->setIdmeaning($this->id_meaning);

        $modelProductsOrders = $this->modelProductsOrders;

        $return = $this->modelProductsOrders->selectInfosProductsOrders($modelProductsOrders);

        echo json_encode($return);
    }

    // ==========================================================================================//
    // !                           Method to add size to the product                             //
    // ==========================================================================================//
    public function addProductsSizes()
    {
        $this->id_product = $this->input->post('id_product');
        $this->id_size = $this->input->post('id_size');

        /***************Creation of my object******************/
        $this->modelProductsSizes->setIdProduct($this->id_product);
        $this->modelProductsSizes->setIdSize($this->id_size);
        $modelProductsSizes = $this->modelProductsSizes;
        /****************************************************/

        /*If the product size does not exist, create it*/
        $result = $this->modelProductsSizes->selectProductsBySizes($modelProductsSizes);
        $callBack;

        if ($result == "not exist") {
            $this->modelProductsSizes->insertProductsSizes($modelProductsSizes);
            $callBack = "products sizes created";
        } else {
            $callBack = "products sizes already exist";
        }

        echo json_encode($callBack);

    }

    // ==========================================================================================//
    // !                           Method to add color to the product                             //
    // ==========================================================================================//
    public function addProductsColors()
    {
        $this->id_product = $this->input->post('id_product');
        $this->id_color = $this->input->post('id_color');

        /***************Creation of my object******************/
        $this->modelProductsColors->setIdProduct($this->id_product);
        $this->modelProductsColors->setIdColor($this->id_color);
        $modelProductsColors = $this->modelProductsColors;
        /****************************************************/

        /*If the product size does not exist, create it*/
        $result = $this->modelProductsColors->selectProductsByColors($modelProductsColors);

        $callBack;

        if ($result == "not exist") {
            $this->modelProductsColors->insertProductsColors($modelProductsColors);
            $callBack = "products colors created";
        } else {
            $callBack = "products colors already exist";
        }

        echo json_encode($callBack);
    }

    // ==========================================================================================//
    // !                           Method to add meaning to the product                             //
    // ==========================================================================================//
    public function addProductsMeanings()
    {
        $this->id_product = $this->input->post('id_product');
        $this->id_meaning = $this->input->post('id_meaning');

        /***************Creation of my object******************/
        $this->modelProductsMeanings->setIdProduct($this->id_product);
        $this->modelProductsMeanings->setIdMeaning($this->id_meaning);
        $modelProductsMeanings = $this->modelProductsMeanings;
        /****************************************************/

        /*If the product size does not exist, create it*/
        $result = $this->modelProductsMeanings->selectProductsByMeanings($modelProductsMeanings);

        $callBack;

        if ($result == "not exist") {
            $this->modelProductsMeanings->insertProductsMeanings($modelProductsMeanings);
            $callBack = "products meanings created";
        } else {
            $callBack = "products meanings already exist";
        }

        echo json_encode($callBack);
    }

    // ==========================================================================================//
    // !                           Method for create pdf orders recap                           //
    // ==========================================================================================//

    public function generatePdfOrders()
    {

        $this->id_order = $this->input->get('id_order');

        // Retrieving order information
        $infosOrders = $this->modelOrders->selectAllOrders($this->id_order);
        // Retrieving order information
        $infosProductsOrders = $this->modelProductsOrders->selectAllProductsOrders($this->id_order);

        ob_start();
        require_once APPPATH . 'views/pdf/pdf_template_orders_recap.tpl';
        $content = ob_get_clean();
    
        $objPdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $objPdf->SetCreator(PDF_CREATOR);
        $objPdf->SetTitle("Récapitulatif de la commande N°" .$this->id_order);
        $objPdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $objPdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $objPdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $objPdf->SetDefaultMonospacedFont('helvetica');
        $objPdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $objPdf->SetMargins(PDF_MARGIN_LEFT, '0', PDF_MARGIN_RIGHT);
        $objPdf->setPrintHeader(false);
        $objPdf->setPrintFooter(false);
        $objPdf->SetAutoPageBreak(true, 10);
        $objPdf->SetFont('helvetica', '', 12);
        $objPdf->AddPage();
        $objPdf->writeHTML($content);
        $objPdf->Output('Commande-' . $this->id_order . '.pdf', 'D');

    }

}
