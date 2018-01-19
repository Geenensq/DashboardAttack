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
    private $id_group_color;
    private $id_group_size;
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
    }

// =======================================================================//
// !                         Default method                              //
// ======================================================================//
    public function index()
    {
        $data = $this->modelGroupsProducts->selectAll();
        $array = [];
        $array['groups'] = $data;

        $this->load->view('dashboard/products.html' , $array);
    }
// =======================================================================//
// !                  Method for upload an image                         //
// ======================================================================//

    public function addGroupProducts()
    {
        $this->form_validation->set_rules('name_group_product', '"name_group_product"', 'required');
        $this->form_validation->set_rules('description_group_products', '"description_group_products"', 'required');

        $callBack = array();
        if ($this->form_validation->run()) {

            /*Retrieving my POST values ​​to store them in my attributes*/
            $this->name_group_product = $this->input->post('name_group_product');
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


// =======================================================================//
// !                   Method for add groups of products                 //
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
// !            Method for send groups products on datatable             //
// ======================================================================//

    public function getInfosGroupsProductsModal()
    {
        $this->id_group_product = $this->input->post('id');

        $return = $this->modelGroupsProducts->selectAllGroupsProductForModal($this->id_group_product);
        echo json_encode($return);
    }


// ==========================================================================================//
// !               Method get all informations of groups products for modal                  //
// ==========================================================================================//

    public function changeStatusGroupProducts()
    {
        $this->id_group_product = $this->input->post('id');
        $this->modelGroupsProducts->disableEnableOneGroupProducts($this->id_group_product);
    }



// =======================================================================//
// !          Method for activate or desactivate group of products         //
// ======================================================================//

    public function changeNameGroupProducts()
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


// ==========================================================================================//
// !                Method for change informations of color group for modal                  //
// ==========================================================================================//

    public function addProducts()
    {
        $this->img_url = $this->uploadImage();

        if ($this->img_url != 'errorImageFormat') {

            $this->form_validation->set_rules('product_name', '"product_name"', 'required');
            $this->form_validation->set_rules('product_ref', '"product_ref"', 'required');
            $this->form_validation->set_rules('product_desc', '"product_desc"', 'required');
            $this->form_validation->set_rules('product_price', '"product_price"', 'required');
            $this->form_validation->set_rules('product_color', '"product_color"', 'required');
            $this->form_validation->set_rules('product_group', '"product_group"', 'required');
            $this->form_validation->set_rules('product_size', '"product_size"', 'required');


            $callBack = array();
            if ($this->form_validation->run()) {

                /*Retrieving my POST values ​​to store them in my attributes*/
                $this->product_name = $this->input->post('product_name');
                $this->reference = $this->input->post('product_ref');
                $this->description = $this->input->post('product_desc');
                $this->base_price = $this->input->post('product_price');
                $this->id_group_color = $this->input->post('product_color');
                $this->id_group_product = $this->input->post('product_group');
                $this->id_group_size = $this->input->post('product_size');


                /* ----------------------------Create my object----------------------------------*/
                $this->modelProducts->setName($this->product_name);
                $this->modelProducts->setReference($this->reference);
                $this->modelProducts->setDescription($this->description);
                $this->modelProducts->setBasePrice($this->base_price);
                $this->modelProducts->setIdGroupColor($this->id_group_color);
                $this->modelProducts->setIdGroupProduct($this->id_group_product);
                $this->modelProducts->setIdGroupSize($this->id_group_size);
                $this->modelProducts->setImgUrl($this->img_url);

                $modelProducts = $this->modelProducts;
                $this->modelProducts->insertOneProducts($modelProducts);
                $callBack["confirm"] = "success";

            }


        } else {

            $callBack["confirm"] = "error";
        }

        echo json_encode($callBack);


    }

// =======================================================================//
// !                      Method for add an products                     //
// ======================================================================//

    public function uploadImage()
    {

        $config['upload_path'] = './uploads/';
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