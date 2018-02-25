<?php
/**
 * Dashboard Attack, command manager
 * colors_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

Class Colors_controller extends CI_Controller
{

    //----Attributes groups colors----//
    private $id_group_color;
    private $name_group_colors;

    //----Attributes colors----//
    private $id_color;
    private $color_name;
    private $color_code;


// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//

    public function __construct()
    {
        parent::__construct();
        $this->load->model('colors_model', 'modelColors');
        $this->load->model('groups_colors_model', 'modelGroupsColors');
    }



// =======================================================================//
// !                         Default method                              //
// ======================================================================//
    public function index()
    {
        $data = $this->modelGroupsColors->selectAll();
        //---------------------------------------------------------//
        $array = [];
        $array['groups'] = $data;
        $this->load->view('dashboard/colors.html' , $array);

    }


// =======================================================================//
// !                   Method for add colors                             //
// ======================================================================//
    public function addColors()
    {
        $this->form_validation->set_rules('color_name', '"color_name"', 'required');
        $this->form_validation->set_rules('color_code', '"color_code"', 'required');
        $this->form_validation->set_rules('name_group_for_color', '"name_group_for_color"', 'required');

        $callBack = array();
        if ($this->form_validation->run()){

            /*Retrieving my POST values ​​to store them in my attributes*/
            $this->name_group_colors = $this->input->post('name_group_for_color');
            $this->color_name = $this->input->post('color_name');
            $this->color_code = $this->input->post('color_code');

            /* ----------------------------Create my object----------------------------------*/
            $this->modelColors->setIdGroupColor($this->name_group_colors);
            $this->modelColors->setColorName($this->color_name);
            $this->modelColors->setColorCode($this->color_code);

            $modelColors = $this->modelColors;
            $this->modelColors->insertOneColor($modelColors);

            $callBack["confirm"] = "success";
        } else {

            $callBack["confirm"] = "error";
        }

        echo json_encode($callBack);

    }




// =======================================================================//
// !                   Method for add groups colors                      //
// ======================================================================//

    public function addGroupColors()
    {
        $this->form_validation->set_rules('name_group_colors', '"name_group_colors"', 'required');
        $callBack = array();

        if ($this->form_validation->run()){

            /*Retrieving my POST values ​​to store them in my attributes*/
            $this->name_group_colors = $this->input->post('name_group_colors');

            /* ----------------------------Create my object----------------------------------*/
            $this->modelGroupsColors->setNameGroupColors($this->name_group_colors);
            $modelGroupsColors = $this->modelGroupsColors;

            $this->modelGroupsColors->insertOneGroupColors($modelGroupsColors);

            $callBack["confirm"] = "success";
        } else {

            $callBack["confirm"] = "error";
        }

        echo json_encode($callBack);

    }


// =======================================================================//
// !            Method for send groups colors on datatable               //
// ======================================================================//
    public function encodeGridGroupsColors()
    {
        $results = $this->modelGroupsColors->loadDataGroupsColorsDataTable();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_group_color'], $result['name_group_color'], $result['actif']);
        }

        echo json_encode(array('data' => $data));
    }

// =======================================================================//
// !                 Method for send colors on datatable                 //
// ======================================================================//
    public function encodeGridColors()
    {
        $results = $this->modelColors->loadDataColorsDataTable();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_color'], $result['color_name'], $result['color_code'],$result['actif'],$result['name_groups_colors']);
        }

        echo json_encode(array('data' => $data));
    }


// =======================================================================//
// !          Method for activate or desactivate group of colors         //
// ======================================================================//
    public function changeStatusGroupColors()
    {
        $this->id_group_color = $this->input->post('id');
        $this->modelGroupsColors->disableEnableOneGroupColor($this->id_group_color);
    }


// =======================================================================//
// !          Method for activate or desactivate group of colors         //
// ======================================================================//
    public function changeStatusColors()
    {
        $this->id_color = $this->input->post('id');
        $this->modelColors->disableEnableOneColor($this->id_color);
    }


// ==========================================================================================//
// !                Method get all informations of groups color for modal                    //
// ==========================================================================================//

    public function getInfosGroupsColorsModal()
    {
        $this->id_group_color = $this->input->post('id');

        $return = $this->modelGroupsColors->selectAllGroupsColorForModal($this->id_group_color);
        echo json_encode($return);
    }

// ==========================================================================================//
// !                   Method get all informations of color for modal                        //
// ==========================================================================================//

    public function getInfosColorsModal()
    {
        $this->id_color = $this->input->post('id');
        $return = $this->modelColors->selectAllColorsForModal($this->id_color);
        echo json_encode($return);
    }

// ==========================================================================================//
// !                Method for change informations of color group for modal                  //
// ==========================================================================================//

    public function changeNameGroupColors()
    {

        $this->form_validation->set_rules('new_name_group_colors', '" "', 'required|min_length[3]');
        $callBack = array();

        if ($this->form_validation->run())
        {
            $this->modelGroupsColors->setIdGroupColor($this->input->post('new_id_group_color'));
            $this->modelGroupsColors->setNameGroupColors($this->input->post('new_name_group_colors'));
            
            $groupColors = $this->modelGroupsColors;

            $this->modelGroupsColors->updateNameGroupColors($groupColors);
            $callBack["confirm"] = "success";

        } else{

            $callBack["errorNewNameGroup"] = "error";
        }

        echo json_encode($callBack);
    }

// ==========================================================================================//
// !                    Method for change informations of color for modal                    //
// ==========================================================================================//
    public function changeNameColors()
    {
        $this->form_validation->set_rules('id_color', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_name_color',  '" "', 'required|min_length[2]');
        $this->form_validation->set_rules('new_code_color', '" "', 'required|min_length[1]');

        $callBack = array();

        if ($this->form_validation->run())
        {
            $this->modelColors->setIdColor($this->input->post('id_color'));
            $this->modelColors->setColorName($this->input->post('new_name_color'));
            $this->modelColors->setColorCode($this->input->post('new_code_color'));
            $this->modelColors->setIdGroupColor($this->input->post('new_group_color'));
            
            $color = $this->modelColors;

            $this->modelColors->updateNameColors($color);
            $callBack["confirm"] = "success";

        } else{

            $callBack["errorNewNameColor"] = "error";
        }

        echo json_encode($callBack);
    }





}

?>