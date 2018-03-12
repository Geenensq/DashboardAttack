<?php
/**
 * Dashboard Attack, command manager
 * signup_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

class Signup_controller extends CI_Controller
{

    // =======================================================================//
    // !                  Declaration of my attributes                       //
    // ======================================================================//
    private $login;
    private $email;
    private $password;
    private $password_confirm;
    private $actif;
    private $id_group_member;

    // =======================================================================//
    // !                  Constructor of my Class                            //
    // ======================================================================//

    //Instance all methods of CI_CONTROLLER
    public function __construct()
    {
        parent::__construct();

        $this->load->model('members_model', 'modelMembers');
        $this->load->helper('password');

        $this->actif = 1;
        $this->id_group_member = 3;
        $this->login = $this->input->post('login');
        $this->email = $this->input->post('email');
        $this->password = $this->input->post('password');
        $this->password_confirm = $this->input->post('password2');
    }

    // =======================================================================//
    // !                         Default method                              //
    // ======================================================================//
    public function index()
    {
        if ($this->session->userdata('id_member')) {
            redirect(array('login_controller', 'index'));
        } else {

            $this->load->view('signup/index.html');
        }

    }

    // =======================================================================//
    // !                      Method for signup users                        //
    // ======================================================================//

    public function signup()
    {
        $this->form_validation->set_rules('login', '"login"', 'required|min_length[3]');
        $this->form_validation->set_rules('email', '"Email adress"', 'valid_email|required|min_length[1]');
        $this->form_validation->set_rules('password', '"Password"', 'required|min_length[2]');
        $this->form_validation->set_rules('password2', '"Password confirm"', 'required|min_length[2]');

        //------------------------If the form is valid and password & password confirm matches ---------------------//
        if ($this->form_validation->run() && $this->password === $this->password_confirm) {
            //-------------Create my objet--------------//
            $this->modelMembers->setLogin($this->login);
            $this->modelMembers->setEmail($this->email);
            
            // In my model i hash my password with helpers
            $this->modelMembers->setPassword(hash_password($this->password));
            $this->modelMembers->setActif($this->actif);
            $this->modelMembers->SetIdGroupMember($this->id_group_member);
            //-----------------------------------------//
            
            $membersModel = $this->modelMembers;
            $this->modelMembers->insertOneMember($membersModel);
            redirect(array('login_controller', 'index'));

        } else {
            $this->index();
        }

    }

}
