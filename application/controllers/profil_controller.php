<?php 

Class Profil_controller extends CI_Controller
{
	private $id_member;
    private $password;
	private $newPassword;
    private $newPasswordConfirm;
    private $email;


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
   		} else {

             $this->index();

        }
    }

    public function editPasswordProfil()
    {
            //------------------------Get informations of the Ajax POST----------------------//
            $this->password = $this->input->post('currentPassword');
            $this->newPassword = $this->input->post('newPassword');
            $this->newPasswordConfirm = $this->input->post('newPasswordConfirmation');
            //------------------------------------------------------------------------------//
           
           //---------------------------------Check current password before the update----------------------------// 
           
            //-------------Create my objet for test password and id--------------//
            $this->modelMembers->setId($this->id_member);
            $this->modelMembers->setPassword($this->password);
            //-----------------------------------------------------------------//
            
            //----------------Launch méthod for check the password and the id-----------------------//
            $membersModel = $this->modelMembers;
            $resultRequest = $this->modelMembers->checkPasswordById($membersModel);
            //-------------------------------------------------------------------------------------//

            //-----------------------------If the users have the same password of the post so update---------------//
            $callBack = array();

            if ($resultRequest){

                if ($this->newPasswordConfirm == $this->newPassword ){
                    
                    $this->modelMembers->setId($this->id_member);
                    $this->modelMembers->setPassword($this->newPassword);
                    $membersModel = $this->modelMembers;
                    $this->modelMembers->updateProfilMemberPassword($membersModel);
                    $callBack["confirm"] = "success";

                } else {

                    $callBack["errorPasswordConfirm"] = "error";
                
                }
              
            } else {

               $callBack["errorPasswordActuel"] = "error";
            } 
            //----------------------------------------------------------------------------------------------------//
            
            echo json_encode($callBack);
    }     





}
 ?>