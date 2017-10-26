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
            $this->modelMembers->setId("2");
            $this->modelMembers->setLogin("kevin");
            $this->modelMembers->setPassword("1234567");
            $this->modelMembers->setActif("1");
            $this->modelMembers->setEmail("kevin@gg.fr");
            $this->modelMembers->SetIdGroupMember(1);
            $membersModel = $this->modelMembers;
            $addmembers =  $this->modelMembers->DisableMember($membersModel); 
        }

}

 ?>



