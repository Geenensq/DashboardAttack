<?php 
Class Tester_controller extends CI_Controller
{

        public function __construct()
        {
        parent::__construct();
        $this->load->model('members_model' , 'modelMembers');
        }

        public function index()
        {
            $this->modelMembers->setLogin("test");
            $this->modelMembers->setPassword("test");
            $this->modelMembers->setActif("1");
            $this->modelMembers->setEmail("test");
            $this->modelMembers->SetIdGroupMember(1);
            $membersModel = $this->modelMembers;
            $addmembers =  $this->modelMembers->insertMember($membersModel); 
        }

}

 ?>



