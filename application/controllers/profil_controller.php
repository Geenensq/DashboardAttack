<?php 

Class Profil_controller extends CI_Controller
{
	private $id_member;
	private $email;
	private $password;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('members_model' , 'modelMembers');
        
        $this->id_member = $this->input->post('id_member');
        $this->email = $this->input->post('email');
        $this->password = $this->input->post('password');


    }

    public function index()
    {
        $this->load->view('dashboard/profil.html');

    }

    public function editProfil()
    {
   		//---------------------------------------FORM VALIDATION--------------------------------------------//
   		$this->form_validation->set_rules('password', '"password"', 'required|min_length[3]');
    	$this->form_validation->set_rules('email', '"Email adress"', 'required|valid_email|min_length[1]');
    	//--------------------------------------------------------------------------------------------------//
    	

    	if ($this->form_validation->run())
        {
        	//-------------Create my objet--------------//
        	$this->modelMembers->setId($this->id_member);
        	$this->modelMembers->setEmail($this->email);
            $this->modelMembers->setPassword($this->password);
            //-----------------------------------------//
            
            $membersModel = $this->modelMembers;
            $this->modelMembers->updateMember($membersModel);
            
   		}



}

}
 ?>