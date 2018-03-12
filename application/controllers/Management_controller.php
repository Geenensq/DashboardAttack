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
    private $login;
    private $password;
    private $password_confirm;
    private $email;
    private $id_group_member;

// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Members_model', 'modelMembers');
        $this->load->model('Groups_members_model', 'modelGroupsMembers');
        $this->load->helper('password');

    }

// =======================================================================//
// !                         Default method                              //
// ======================================================================//
    public function index()
    {
        if($this->session->userdata('id_member')){

            if($this->session->userdata('id_member') != 1){
                $data = $this->modelGroupsMembers->selectAll();
                $array = [];
                $array['groups_members'] = $data;
                $this->load->view('dashboard/management.html' , $array);

            } else {
                $this->load->view('errors/html/error_403.php');
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
// !                   Method get all informations of members for modal                      //
// ==========================================================================================//

    public function changeInfosMembersModal()
    {   
        $this->form_validation->set_rules('id_member', '" "', 'required');
        $this->form_validation->set_rules('login_member', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('email_member', '" "', 'required|valid_email|min_length[3]');
        $this->form_validation->set_rules('new_group_member', '" "', 'required');
        
        if ($this->form_validation->run()) 
        {
            $this->id_member = $this->input->post('id_member');
            $this->login = $this->input->post('login_member');
            $this->email = $this->input->post('email_member');
            $this->id_group_member = $this->input->post('new_group_member');

            $this->modelMembers->setId($this->id_member);
            $this->modelMembers->setLogin($this->login);
            $this->modelMembers->setEmail($this->email);
            $this->modelMembers->SetIdGroupMember($this->id_group_member);
            $this->modelMembers->setActif(1);
            $membersModel = $this->modelMembers;
            $this->modelMembers->updateMembersModal($membersModel);

            $callBack["confirm"] = "success";
            echo json_encode($callBack);
        } else{

            $callBack["confirm"] = "error";
            echo json_encode($callBack);

        }

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
            $this->password = $this->input->post('password_member');
            $this->password_confirm = $this->input->post('password_member_confirmation');
           
            if($this->password ===  $this->password_confirm)
            {
                $this->modelMembers->setId($this->id_member);

                $this->modelMembers->setPassword(hash_password($this->password));
                $membersModel = $this->modelMembers;
                $this->modelMembers->updatePasswordMembers($membersModel);

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
// !          Method for activate or desactivate group of colors         //
// ======================================================================//
    public function changeStatusMembers()
    {
        $this->id_member = $this->input->post('id');
        $this->modelMembers->disableEnableOneMember($this->id_member);
    }


}

?>
