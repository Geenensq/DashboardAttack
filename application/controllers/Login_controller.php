<?php
/**
 * Dashboard Attack, command manager
 * customers_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

class Login_controller extends CI_Controller
{
    // =======================================================================//
    // !                  Declaration of my attributes                       //
    // ======================================================================//
    private $login;
    private $password;
    private $id_member;
    private $actif;
    private $email;
    private $id_group_member;

    // =======================================================================//
    // !                  Constructor of my Class                            //
    // ======================================================================//
    public function __construct()
    {
        parent::__construct();
        $this->load->model('members_model', 'modelMembers');
        $this->load->helper('password');
        $this->login = $this->input->post('login');
        $this->password = $this->input->post('password');
    }

    // =======================================================================//
    // !                         Default method                              //
    // ======================================================================//
    public function index()
    {
        if ($this->session->userdata('id_member')) {
            redirect(array('dashboard_controller', 'index'));
        } else {
            $this->load->view('login/index.html');
        }

    }

    // =======================================================================================//
    // !                 Check if the user and password exist and matches                    //
    // ======================================================================================//
    public function checkLogin()
    {
        $this->form_validation->set_rules('login', '"Nom d\'utilisateur"', 'required|min_length[2]');
        $this->form_validation->set_rules('password', '"Mot de passe"', 'required|min_length[2]');

        if ($this->form_validation->run()) {

            //-------------Create my objet--------------//
            $this->modelMembers->setLogin($this->login);
            $this->modelMembers->setPassword(hash_password($this->password));
            //-----------------------------------------//

            $membersModel = $this->modelMembers;
            $checkMember = $this->modelMembers->checkInfoUser($membersModel);

            if ($checkMember != false && $checkMember->getActif() == 1) {

                $this->id_member = $checkMember->getId();
                $this->actif = $checkMember->getActif();
                $this->email = $checkMember->getEmail();
                $this->id_group_member = $checkMember->getIdGroupMember();
                $this->loginValid();

            } else {

                $this->index();
            }

        } else {
            $this->load->view('login/index.html');
        }

    }

    // =======================================================================//
    // !                  Method for assign session to user                  //
    // ======================================================================//
    private function loginValid()
    {
        //------------------Iinialize session-------------------//
        $this->session->set_userdata('id_member', $this->id_member);
        $this->session->set_userdata('id_group_member', $this->id_group_member);
        //------------------------------------------------------//

        redirect(array('dashboard_controller', 'index'));
    }

}
