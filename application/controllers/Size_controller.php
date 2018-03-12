<?php
/**
 * Dashboard Attack, command manager
 * size_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

class Size_controller extends CI_Controller
{

    /*-----Attributes sizes declaration-----*/
    private $size_name;
    private $id_size;
    private $price;
    private $id_group_size;
    /*-------------------------------------*/

    private $name_group_size;
    private $actif;
    private $nameGroupForSizes;

// =======================================================================//
    // !                  Constructor of my Class                            //
    // ======================================================================//

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sizes_model', 'modelSizes');
        $this->load->model('Groups_sizes_model', 'modelGroupSizes');

        $this->name_group_size = $this->input->post('name_group_sizes');
    }

// =======================================================================//
    // !                         Default method                              //
    // ======================================================================//
    public function index()
    {
        if ($this->session->userdata('id_member')) {
            $data = $this->modelGroupSizes->selectAll();
            //---------------------------------------------------------//
            $array = [];
            $array['groups'] = $data;
            $this->load->view('dashboard/size.html', $array);
        } else {
            redirect(array('login_controller', 'index'));
        }
    }

// =======================================================================//
    // !                   Method for add sizes                              //
    // ======================================================================//
    public function addSizes()
    {
        $this->form_validation->set_rules('size_name', '"size_name"', 'required');
        $this->form_validation->set_rules('size_price', '"size_price"', 'required');
        $this->form_validation->set_rules('name_group_for_size', '"name_group_for_size"', 'required');

        $callBack = array();
        if ($this->form_validation->run()) {

            /*Retrieving my POST values ​​to store them in my attributes*/
            $this->name_group_size = $this->input->post('name_group_for_size');
            $this->size_name = $this->input->post('size_name');
            $this->price = $this->input->post('size_price');

            /* ----------------------------Create my object----------------------------------*/
            $this->modelSizes->setIdGroupSize($this->name_group_size);
            $this->modelSizes->setName($this->size_name);
            $this->modelSizes->setPrice($this->price);

            $modelSizes = $this->modelSizes;
            $this->modelSizes->insertOneSize($modelSizes);

            $callBack["confirm"] = "success";
        } else {

            $callBack["confirm"] = "error";
        }

        echo json_encode($callBack);

    }

// =======================================================================//
    // !                    Method for add groups sizes                      //
    // ======================================================================//

    public function addGroupsSizes()
    {
        /*Declaration of the rules of my form*/
        $this->form_validation->set_rules('name_group_sizes', '"name_group_sizes"', 'required|min_length[3]');

        if ($this->form_validation->run()) {
            $callBack = array();
            $this->modelGroupSizes->setNameGroupSize($this->name_group_size);
            $this->modelGroupSizes->insertOneGroupSizes($this->modelGroupSizes);

            $callBack["confirm"] = "success";

        } else {
            $callBack["confirm"] = "error";
        }
        echo json_encode($callBack);

    }

    // =======================================================================//
    // !              Method for send groups sizes on datatable               //
    // ======================================================================//
    public function encodeGridGroupsSizes()
    {
        $results = $this->modelGroupSizes->loadDataGroupsSizesDataTable();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_group_size'], $result['name_group_size'], $result['actif']);
        }

        echo json_encode(array('data' => $data));
    }

// =======================================================================//
    // !                 Method for send colors on datatable                 //
    // ======================================================================//
    public function encodeGridSizes()
    {
        $results = $this->modelSizes->loadDataSizesDataTable();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_size'], $result['size_name'], $result['price'], $result['actif'], $result['name_groups_sizes']);
        }

        echo json_encode(array('data' => $data));
    }

// =======================================================================//
    // !          Method for activate or desactivate group of sizes          //
    // ======================================================================//
    public function changeStatusGroupsSizes()
    {
        $this->id_group_size = $this->input->post('id');
        $this->modelGroupSizes->disableEnableOneGroupSizes($this->id_group_size);
    }

// =======================================================================//
    // !          Method for activate or desactivate group of colors         //
    // ======================================================================//
    public function changeStatusSizes()
    {
        $this->id_size = $this->input->post('id');
        $this->modelSizes->disableEnableOneSize($this->id_size);
    }

// ==========================================================================================//
    // !                    Method for change informations of size for modal                     //
    // ==========================================================================================//

    public function changeNameGroupsSizes()
    {

        $this->form_validation->set_rules('new_name_group_sizes', '" "', 'required|min_length[1]');
        $callBack = array();

        if ($this->form_validation->run()) {
            $this->modelGroupSizes->setIdGroupSize($this->input->post('new_id_group_sizes'));
            $this->modelGroupSizes->setNameGroupSize($this->input->post('new_name_group_sizes'));

            $groupSizes = $this->modelGroupSizes;

            $this->modelGroupSizes->updateNameGroupSizes($groupSizes);
            $callBack["confirm"] = "success";

        } else {

            $callBack["errorNewNameGroup"] = "error";
        }

        echo json_encode($callBack);
    }

    // ==========================================================================================//
    // !                    Method for change informations of sizes for modal                    //
    // ==========================================================================================//
    public function changeNameSizes()
    {
        $this->form_validation->set_rules('new_id_sizes', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_name_sizes', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_price_sizes', '" "', 'required|min_length[1]');

        $callBack = array();

        if ($this->form_validation->run()) {
            $this->modelSizes->setIdSize($this->input->post('new_id_sizes'));
            $this->modelSizes->setName($this->input->post('new_name_sizes'));
            $this->modelSizes->setPrice($this->input->post('new_price_sizes'));
            $this->modelSizes->setIdGroupSize($this->input->post('new_group_sizes'));

            $size = $this->modelSizes;

            $this->modelSizes->updateNameSize($size);
            $callBack["confirm"] = "success";

        } else {

            $callBack["errorNewNameSize"] = "error";
        }

        echo json_encode($callBack);
    }

// ==========================================================================================//
    // !                Method get all informations of groups size for modal                    //
    // ==========================================================================================//

    public function getInfosGroupsSizesModal()
    {
        $this->id_group_size = $this->input->post('id');

        $return = $this->modelGroupSizes->selectAllGroupsSizesForModal($this->id_group_size);
        echo json_encode($return);
    }

// ==========================================================================================//
    // !                   Method get all informations of sizes for modal                        //
    // ==========================================================================================//

    public function getInfosSizesModal()
    {
        $this->id_size = $this->input->post('id');
        $return = $this->modelSizes->selectAllSizesForModal($this->id_size);
        echo json_encode($return);
    }

}
