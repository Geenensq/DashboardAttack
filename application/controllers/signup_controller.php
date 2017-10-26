<?php 
Class Signup_controller extends CI_Controller
{
        private $login;
        private $email;
        private $password;
        private $password_confirm;
        private $actif;
        private $id_group_member;

        public function __construct()
        {
        parent::__construct();
        $this->load->model('members_model' , 'modelMembers');
        $this->actif = 0;
        $this->id_group_member = 3;
        $this->login = $this->input->post('login');
        $this->email = $this->input->post('email');
        $this->password = $this->input->post('password');
        $this->password_confirm = $this->input->post('password2');
        }

        public function index()
        {
            $this->load->view('signup/index.html');
        }

        public function signup()
        {
            //---------------------------------------FORM VALIDATION--------------------------------------------//
            $this->form_validation->set_rules('login', '"login"', 'required|min_length[3]');
            $this->form_validation->set_rules('email', '"Email adress"', 'valid_email|required|min_length[1]');
            $this->form_validation->set_rules('password', '"Password"', 'required|min_length[2]');
            $this->form_validation->set_rules('password2', '"Password confirm"', 'required|min_length[2]');
            //--------------------------------------------------------------------------------------------------//
            
            if ($this->form_validation->run() && $this->password === $this->password_confirm)
            {
                //-------------Create my objet--------------//
                $this->modelMembers->setLogin($this->login);
                $this->modelMembers->setEmail($this->email);
                $this->modelMembers->setPassword($this->password);
                $this->modelMembers->setActif($this->actif);
                $this->modelMembers->SetIdGroupMember($this->id_group_member);
            //-----------------------------------------//
                $membersModel = $this->modelMembers;
                $checkMember =  $this->modelMembers->insertMember($membersModel);

            } else {

                //----------------------------If the form is'nt valid load the base view and display error------------------------------// 
                 $this->load->view('signup/index.html');
                //----------------------------------------------------------------------------------------------------------------------//    
            }








        }

}

 ?>



