<?php
Class Login_controller extends CI_Controller
{
    //--------------Declarations of attributes-------------//
    private $pseudo;
    private $mdp;
    private $id;
    private $email;
     
    //-----------------------------------------------------//

    //-------------------Constructor-----------------//
    public function __construct()
    {
        parent::__construct();
        $this->load->model('members_model' , 'modelMembers');
        $this->pseudo = $this->input->post('pseudo');
        $this->mdp = $this->input->post('mdp');
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
        $this->form_validation->set_rules('pseudo', '"Nom d\'utilisateur"', 'required|min_length[2]');
        $this->form_validation->set_rules('mdp', '"Mot de passe"', 'required|min_length[2]');
        //-----------------------------------------------------------------------------------------------------------------------//
        
        
        //---------------------------------------------If the form is valid-----------------------------------------------------//
        if ($this->form_validation->run())
        {
            //-------------Create my objet--------------//
            $this->modelMembers->setLogin($this->pseudo);
            $this->modelMembers->setPassword($this->mdp);
            //-----------------------------------------//
            
            $membersModel = $this->modelMembers;
            $checkMember =  $this->modelMembers->CheckInfoUser($membersModel);
        
            //--DO IT : MAKE AN FUNCTION AND TRASH THIS NOOB METHOD--//
            // $this->email = $checkMember['0']->getEmail();
            // $this->id = $checkMember['0']->getId();
            //-------------------------------------------------------//

                if (count($checkMember) >= 1 ) {

                    $this->loginValid();   
                } else {    
                    
                   $this->loginInvalid();
                }    
        //-----------------------------------------------------------------------------------------------------------------------//
       
        } else 

        //----------------------------If the form is'nt valid load the base view and display error------------------------------// 
            {
             $this->load->view('login/index.html');
            }
        //----------------------------------------------------------------------------------------------------------------------//    
    
    }

    //----------------------------------------------------------------------------------------------------------------------//     
    private function loginValid()
    {
        $this->session->set_userdata('id_member',  $this->id);
        $this->session->set_userdata('login',  $this->pseudo);
        $this->session->set_userdata('password',  $this->mdp);
        $this->session->set_userdata('email',  $this->email);
        redirect(array('dashboard_controller', 'index'));  
    }
    //----------------------------------------------------------------------------------------------------------------------//
    private function loginInvalid()
    {
        $this->load->view('login/index.html');
    }
    //----------------------------------------------------------------------------------------------------------------------//

}