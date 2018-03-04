<?php
/**
 * Dashboard Attack, command manager
 * products_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

Class Products_controller extends CI_Controller
{
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    private $name_group_product;
    private $id_group_product;

    private $id_product;
    private $product_name;
    private $reference;
    private $description;
    private $base_price;
    private $img_url;

// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('groups_products_model', 'modelGroupsProducts');
        $this->load->model('products_model', 'modelProducts');
        $this->load->model('groups_colors_model', 'modelGroupsColors');
        $this->load->model('Groups_sizes_model', 'modelGroupSizes');

        $this->load->model('colors_model', 'modelColors');
        $this->load->model('sizes_model', 'modelSizes');
    }

// =======================================================================//
// !                         Default method                              //
// ======================================================================//
    public function index()
    {
        if($this->session->userdata('id_member')){
            $groupsProducts = $this->modelGroupsProducts->selectAll();
            $groupsColors = $this->modelGroupsColors->selectAll();
            $groupsSizes = $this->modelGroupSizes->selectAll();
            
            $array = [];
            $array['groupsProducts'] = $groupsProducts;
            $array['groupsColors'] = $groupsColors;
            $array['groupsSizes'] = $groupsSizes;

            $this->load->view('dashboard/products.html' , $array);
            
        }else{
            redirect(array('login_controller', 'index'));
        }

    }


// =======================================================================//
// !                  Method for add an group of products                 //
// ======================================================================//

    public function addGroupsProducts()
    {
        $this->form_validation->set_rules('name_group_products', '"name_group_products"', 'required');
        $this->form_validation->set_rules('description_group_products', '"description_group_products"', 'required');

        $callBack = array();
        if ($this->form_validation->run()) {

            /*Retrieving my POST values ​​to store them in my attributes*/
            $this->name_group_product = $this->input->post('name_group_products');
            $this->description = $this->input->post('description_group_products');

            /* ----------------------------Create my object----------------------------------*/
            $this->modelGroupsProducts->setName($this->name_group_product);
            $this->modelGroupsProducts->setDescription($this->description);

            $modelGroupsProducts = $this->modelGroupsProducts;
            $this->modelGroupsProducts->insertOneGroupProducts($modelGroupsProducts);

            $callBack["confirm"] = "success";
        } else {

            $callBack["confirm"] = "error";
        }

        echo json_encode($callBack);

    }


// ==========================================================================================//
// !                    Method for change informations of color for modal                    //
// ==========================================================================================//
    public function changeNameProducts()
    {
        $this->form_validation->set_rules('new_id_product', '"new_id_product"', 'required|min_length[1]');
        $this->form_validation->set_rules('new_name_product',  '"new_name_product"', 'required|min_length[1]');
        $this->form_validation->set_rules('new_ref_products', '"new_ref_products"', 'required|min_length[1]');
        $this->form_validation->set_rules('new_desc_product', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_price_product',  '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_group_product', '" "', 'required|min_length[1]');


        $callBack = array();

        if ($this->form_validation->run()) {

            $this->img_url = $this->uploadImage();

            if ($this->img_url != "errorImageFormat") {

                $this->modelProducts->setImgUrl($this->img_url);
                $this->modelProducts->setIdProduct($this->input->post('new_id_product'));
                $this->modelProducts->setName($this->input->post('new_name_product'));
                $this->modelProducts->setReference($this->input->post('new_ref_products'));
                $this->modelProducts->setDescription($this->input->post('new_desc_product'));
                $this->modelProducts->setBasePrice($this->input->post('new_price_product'));
                $this->modelProducts->setIdGroupProduct($this->input->post('new_group_product'));


                $products = $this->modelProducts;
                $this->modelProducts->updateNameProduct($products);
                $callBack["confirm"] = "success";


            } else {

                $this->img_url = $this->input->post('image_hidden');
                $this->modelProducts->setImgUrl($this->img_url);
                $this->modelProducts->setIdProduct($this->input->post('new_id_product'));
                $this->modelProducts->setName($this->input->post('new_name_product'));
                $this->modelProducts->setReference($this->input->post('new_ref_products'));
                $this->modelProducts->setDescription($this->input->post('new_desc_product'));
                $this->modelProducts->setBasePrice($this->input->post('new_price_product'));
                $this->modelProducts->setIdGroupProduct($this->input->post('new_group_product'));


                $products = $this->modelProducts;
                $this->modelProducts->updateNameProduct($products);
                $callBack["confirm"] = "errorformat";

            }

        } else {


            $callBack["confirm"] = "error";
        }

        echo json_encode($callBack);
    }

// ==========================================================================================//
// !                   Method get all informations of products for modal                        //
// ==========================================================================================//

    public function getInfosProductsModal()
    {
        $this->id_product = $this->input->post('id');
        $return = $this->modelProducts->selectAllProductsForModal($this->id_product);
        echo json_encode($return);
    }


// =======================================================================//
// !          Method for send groups products on datatable               //
// ======================================================================//

    public function encodeGridGroupsProducts()
    {
        $results = $this->modelGroupsProducts->loadDataGroupsProductsDataTable();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_group_product'], $result['name_group_product'], $result['description'], $result['actif']);
        }

        echo json_encode(array('data' => $data));
    }


// =======================================================================//
// !               Method for send products on datatable                 //
// ======================================================================//
    public function encodeGridProducts()
    {
        $results = $this->modelProducts->loadDatasProducts();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_product'], $result['product_name'], 
                $result['reference'],$result['description'],$result['base_price'], $result['img_url'],$result['name_groups_products'],$result['actif']);
        }

        echo json_encode(array('data' => $data));
    }

// =======================================================================//
// !                 Method for send groups products on modal             //
// ======================================================================//

    public function getInfosGroupsProductsModal()
    {
        $this->id_group_product = $this->input->post('id');

        $return = $this->modelGroupsProducts->selectAllGroupsProductsForModal($this->id_group_product);
        echo json_encode($return);
    }


// ==========================================================================================//
// !               Method get all informations of groups products for modal                  //
// ==========================================================================================//

    public function changeStatusGroupsProducts()
    {
        $this->id_group_product = $this->input->post('id');
        $this->modelGroupsProducts->disableEnableOneGroupProducts($this->id_group_product);
    }



// =======================================================================//
// !                  Method for EDIT AN GROUPS OF PRODUCTS               //
// ======================================================================//

    public function changeNameGroupsProducts()
    {

        $this->form_validation->set_rules('new_name_group_products', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('new_desc_group_products', '" "', 'required|min_length[1]');
        $callBack = array();

        if ($this->form_validation->run()) {
            $this->modelGroupsProducts->setIdGroupProduct($this->input->post('new_id_group_products'));
            $this->modelGroupsProducts->setName($this->input->post('new_name_group_products'));
            $this->modelGroupsProducts->setDescription($this->input->post('new_desc_group_products'));

            $groupProducts = $this->modelGroupsProducts;

            $this->modelGroupsProducts->updateNameGroupProducts($groupProducts);
            $callBack["confirm"] = "success";

        } else {

            $callBack["errorNewNameGroup"] = "error";
        }

        echo json_encode($callBack);
    }



// =======================================================================//
// !          Method for activate or desactivate group of colors         //
// ======================================================================//
    public function changeStatusProducts()
    {
        $this->id_product = $this->input->post('id');
        $this->modelProducts->disableEnableOneProduct($this->id_product);
    }


// ====================================================//
// !                Method for add an products        //
// ==================================================//

    public function addProducts()
    {
        $this->img_url = $this->uploadImage();


        if ($this->img_url != 'errorImageFormat') {

            $this->form_validation->set_rules('product_name', '"product_name"', 'required');
            $this->form_validation->set_rules('product_ref', '"product_ref"', 'required');
            $this->form_validation->set_rules('product_desc', '"product_desc"', 'required');
            $this->form_validation->set_rules('product_price', '"product_price"', 'required');

            $callBack = array();

            if ($this->form_validation->run()) {


                /*Retrieving my POST values ​​to store them in my attributes*/
                $this->product_name = $this->input->post('product_name');
                $this->reference = $this->input->post('product_ref');
                $this->description = $this->input->post('product_desc');
                $this->base_price = $this->input->post('product_price');
                $this->id_group_product = $this->input->post('product_group');

                $this->modelProducts->setName($this->product_name);
                $this->modelProducts->setReference($this->reference);
                $this->modelProducts->setDescription($this->description);
                $this->modelProducts->setBasePrice($this->base_price);
                $this->modelProducts->setIdGroupProduct($this->id_group_product);
                $this->modelProducts->setImgUrl($this->img_url);

                $modelProducts = $this->modelProducts;
                
                $this->modelProducts->insertOneProduct($modelProducts);
                $callBack["confirm"] = "success";

            } else {

                $callBack["confirm"] = "error";
            }


        } else {

            $callBack["confirm"] = "errorformat";
        }

        echo json_encode($callBack);
    }

// =======================================================================//
// !                      Method for upload an image                     //
// ======================================================================//

    public function uploadImage()
    {

        $config['upload_path'] = './assets/img/uploaded';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {

            $error = 'errorImageFormat';
            return $error;

        } else {

            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            return $file_name;
        }
    }


}