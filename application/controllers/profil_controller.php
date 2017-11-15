<?php 

Class Profil_controller extends CI_Controller
{
	private $id_member;
	private $email;
	//private $password;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('members_model' , 'modelMembers');
        $this->load->model('Groups_members_model' , 'GroupsMembersModel');
        
        //------------------------Stock in my atribute the id of my members with sessions-------------------//
        $this->id_member = $this->session->userdata('id_member');  
        //--------------------------------------------------------------------------------------------------//
    }

    public function index()
    {
        //-----Mysql request for display the informations of user on input-----//
        $infosUser = $this->modelMembers->getOne($this->id_member);
        //---------------------------------------------------------------------//

        //--------------------------Loading of my base view template------------------------------------//
        $this->load->view('dashboard/profil.html' , array('infosUser' => $infosUser[0]) , false);
        //----------------------------------------------------------------------------------------------//
       
    }

    public function editEmailProfil()
    {
   		//---------------------------------------FORM VALIDATION--------------------------------------------//
    	$this->form_validation->set_rules('email', '"Email adress"', 'required|valid_email|min_length[1]');
    	//--------------------------------------------------------------------------------------------------//

    	if ($this->form_validation->run())
        {
            //-----Get my adress mail of my input-----//
            $this->email = $this->input->post('email');
            //---------------------------------------//

        	//-------------Create my objet--------------//
        	$this->modelMembers->setId($this->id_member);
        	$this->modelMembers->setEmail($this->email);
            //-----------------------------------------//
            
            $membersModel = $this->modelMembers;
            $this->modelMembers->updateProfilMember($membersModel);

            //-----Finish reload index-----//
            $this->index();
            //-----------------------------//
   		} 



}

}
 ?>