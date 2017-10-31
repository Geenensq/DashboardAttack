<?php
Class Login_controller extends CI_Controller
{
    //--------------Declarations of attributes-------------//
    private $login;
    private $password;
    private $id_member;
    private $actif;
    private $email;
    private $id_group_member;
    //-----------------------------------------------------//

    //-------------------Constructor-----------------//
    public function __construct()
    {
        parent::__construct();
        $this->load->model('members_model' , 'modelMembers');
        $this->login = $this->input->post('login');
        $this->password = $this->input->post('password');
    }
    //-----------------------------------------------//

    //----------------Default method-----------------//
    public function index()
    {
        $this->load->view('login/index.html');
    }
    //----------------------------------------------//
    
    public function checkLogin()
    {
        //---------------------------------------------------Form Validation-----------------------------------------------------//
        $this->form_validation->set_rules('login', '"Nom d\'utilisateur"', 'required|min_length[2]');
        $this->form_validation->set_rules('password', '"Mot de passe"', 'required|min_length[2]');
        //-----------------------------------------------------------------------------------------------------------------------//
        
        
        //---------------------------------------------If the form is valid-----------------------------------------------------//
        if ($this->form_validation->run())
        {
            //-------------Create my objet--------------//
            $this->modelMembers->setLogin($this->login);
            $this->modelMembers->setPassword($this->password);
            //-----------------------------------------//
            
            $membersModel = $this->modelMembers;
            $checkMember =  $this->modelMembers->CheckInfoUser($membersModel);

                if ($checkMember != false && $checkMember->getActif() == 1 ) 
                {
                    $this->id_member = $checkMember->getId();
                    $this->actif = $checkMember->getActif();
                    $this->email = $checkMember->getEmail();
                    $this->id_group_member = $checkMember->GetIdGroupMember();
                    $this->loginValid();   
                
                } else {    
                    
                   $this->loginInvalid();
                }    
        //-----------------------------------------------------------------------------------------------------------------------//
       
        } else {

        //----------------------------If the form is'nt valid load the base view and display error------------------------------// 
                $this->load->view('login/index.html');
                }
        //----------------------------------------------------------------------------------------------------------------------//    
    
    }

    //----------------------------------------------------------------------------------------------------------------------//     
    private function loginValid()
    {
         //------------------Iinialize session-------------------//
         $this->session->set_userdata('id_member',  $this->id_member);
         $this->session->set_userdata('login',  $this->login);
         $this->session->set_userdata('password',  $this->password);
         $this->session->set_userdata('actif',  $this->actif);
         $this->session->set_userdata('email',  $this->email);
         $this->session->set_userdata('id_group_member',  $this->id_group_member);
        //------------------------------------------------------//

        redirect(array('dashboard_controller', 'index'));  
    }
    //----------------------------------------------------------------------------------------------------------------------//
    
    private function loginInvalid()
    {
        $this->load->view('login/index.html');
    }
    //----------------------------------------------------------------------------------------------------------------------//

}