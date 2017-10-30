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
            $this->modelMembers->setId("3");
            $membersModel = $this->modelMembers;
            $addmembers =  $this->modelMembers->selectGroupMember($membersModel); 
        }

}

 ?>



