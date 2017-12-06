<?php
/**
 * Dashboard Attack, command manager
 * login_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

Class Login_controller extends CI_Controller
{
    //------------------------------------------------------//
    /*--------------Declarations of attributes--------------*/
   //------------------------------------------------------//
    private $login;
    private $password;
    private $id_member;
    private $actif;
    private $email;
    private $id_group_member;
    /*-----------------------------------------------------*/

    //-----------------------------------------------//
    /*-------------------Constructor-----------------*/
    //-----------------------------------------------//
    public function __construct()
    {
        parent::__construct();
        $this->load->model('members_model', 'modelMembers');
        $this->login = $this->input->post('login');
        $this->password = $this->input->post('password');
    }
    /*-----------------------------------------------*/

    //---------------------------------------------------//
    /*-------------------Default method-----------------*/
    //-------------------------------------------------//

    public function index()
    {
        $this->load->view('login/index.html');
    }
    /*--------------------------------------------------*/

    //----------------------------------------------------------------------------------------//
    /*---------------------Method for test if the use exist in database----------------------*/
    //----------------------------------------------------------------------------------------//
    public function checkLogin()
    {
        $this->form_validation->set_rules('login', '"Nom d\'utilisateur"', 'required|min_length[2]');
        $this->form_validation->set_rules('password', '"Mot de passe"', 'required|min_length[2]');

        if ($this->form_validation->run()) {
            $this->modelMembers->setLogin($this->login);
            $this->modelMembers->setPassword($this->password);

            $membersModel = $this->modelMembers;
            $checkMember = $this->modelMembers->CheckInfoUser($membersModel);

            if ($checkMember != false && $checkMember->getActif() == 1) {
                $this->id_member = $checkMember->getId();
                $this->actif = $checkMember->getActif();
                $this->email = $checkMember->getEmail();
                $this->id_group_member = $checkMember->GetIdGroupMember();
                $this->loginValid();

            } else {

                $this->index();
            }

        } else {
            $this->load->view('login/index.html');
        }

    }
    /*-----------------------------------------------------------------------------------------*/

    //--------------------------------------------------------------------------------------------------//
    /*---If the user exists in the database we assign him sessions and we send him the dashboard view---*/
    //--------------------------------------------------------------------------------------------------//
    private function loginValid()
    {
        //------------------Initialize session-------------------//
        $this->session->set_userdata('id_member', $this->id_member);
        $this->session->set_userdata('id_group_member', $this->id_group_member);
        //------------------------------------------------------//

        redirect(array('dashboard_controller', 'index'));
    }
    /*-------------------------------------------------------------------------------------------------*/


}