<?php
/**
 * Dashboard Attack, command manager
 * management_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */


Class Management_controller extends CI_Controller
{
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    private $id_member;
    private $newPassword;
    private $newPasswordConfirm;

// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Members_model', 'modelMembers');
        $this->load->model('Groups_members_model', 'modelGroupsMembers');

    }

// =======================================================================//
// !                         Default method                              //
// ======================================================================//
    public function index()
    {
        if($this->session->userdata('id_member')){

            if($this->session->userdata('id_member') === 1){
            $data = $this->modelGroupsMembers->selectAll();
            $array = [];
            $array['groups_members'] = $data;
            $this->load->view('dashboard/management.html' , $array);

            } else {
                $this->load->view('errors/custom/HTTP403.html');
            }

        }else{
            redirect(array('login_controller', 'index'));
        }
        
    }

 // =======================================================================//
// !                   Method for send members on datatable               //
// ======================================================================//

    public function encodeGridMembers()
    {
        $results = $this->modelMembers->loadMembersDatatable();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_member'], $result['login'], $result['actif'], $result['email'], $result['id_group_member'], $result['name']);
        }

        echo json_encode(array('data' => $data));
    }


// ==========================================================================================//
// !                   Method get all informations of members for modal                      //
// ==========================================================================================//

    public function getInfosMembersModal()
    {
        $this->id_member = $this->input->post('id');
        $return = $this->modelMembers->selectAllMembersForModal($this->id_member);
        echo json_encode($return);
    }


// ==========================================================================================//
// !                         Method for change password in the modal                         //
// ==========================================================================================//

    public function changePasswordMembers()
    { 
        $this->form_validation->set_rules('password_member', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('password_member_confirmation', '" "', 'required|min_length[3]');


        if ($this->form_validation->run()) 
        {      
            $this->id_member = $this->input->post('id_member_password');
            $this->newPassword = $this->input->post('password_member');
            $this->newPasswordConfirm = $this->input->post('password_member_confirmation');
            if($this->newPassword ===  $this->newPasswordConfirm)
            {
                $this->modelMembers->setId($this->id_member);
                $this->modelMembers->setPassword($this->newPassword);
                $membersModel = $this->modelMembers;
                $this->modelMembers->updatePasswordMember($membersModel);

                $callBack["confirm"] = "success";
                echo json_encode($callBack);
            }else {
                $callBack["errorPasswordConfirm"] = "error";
                echo json_encode($callBack);
            }

        } else {
            $this->index();
        }


    }


// =======================================================================//
// !                        Method edit an members                       //
// ======================================================================//

    public function changeMembers()
    {
/*        $this->form_validation->set_rules('id_member', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('login_member', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('email_member', '" "', 'required|min_length[1]');
        
        $callBack = array();

        if ($this->form_validation->run()) {
            $this->modelMembers->setId($this->input->post('new_id_group_products'));
            $this->modelMembers->setLogin($this->input->post('new_name_group_products'));
            $this->modelMembers->setEmail($this->input->post('new_desc_group_products'));

            $groupProducts = $this->modelGroupsProducts;

            $this->modelGroupsProducts->updateNameGroupProducts($groupProducts);
            $callBack["confirm"] = "success";

        } else {

            $callBack["errorNewNameGroup"] = "error";
        }

        echo json_encode($callBack);*/
    }

// =======================================================================//
// !          Method for activate or desactivate group of colors         //
// ======================================================================//
    public function changeStatusMembers()
    {
        $this->id_member = $this->input->post('id');
        $this->modelMembers->disableEnableOneMember($this->id_member);
    }






}

?>