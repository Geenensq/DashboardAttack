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
        $this->id_member = $this->session->userdata('id_member');  
    }


    public function index()
    {
        //-----Get all informations of my user and group user-----//
        $infosUser = $this->modelMembers->getOne($this->id_member);
        //---------------------------------------------------//

        //---Load my view profil and give an array associativ with my variable infouser---//
        $this->load->view('dashboard/profil.html' , array('infosUser' => $infosUser) , false);
        //-------------------------------------------------------------------------------//
    }


    /////////////////////////////
    /// TODO : AJax proccess ///
    ///////////////////////////

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
    $this->password = $this->input->post('current_password');
    $this->newPassword = $this->input->post('new_password');
    $this->newPasswordConfirm = $this->input->post('new_password_confirmation');
    //------------------------------------------------------------------------------//
               
               
    //-------------create my objet for test password and id--------------//
    $this->modelMembers->setId($this->id_member);
    $this->modelMembers->setPassword($this->password);
    //-----------------------------------------------------------------//
                
    //----------------Call my method to verify that the id matches the password-----------------------//
    $membersModel = $this->modelMembers;
    $resultRequest = $this->modelMembers->checkPasswordById($membersModel);
    //-----------------------------------------------------------------------------------------------//

    ///---creating a array to manage ajax returns---//
    $callBack = array();
    //---------------------------------------------//
        //--If the method returns true--//
        if ($resultRequest){
            
            //---------if the 2 passwords are the same----------//
            if ($this->newPasswordConfirm == $this->newPassword )
            {   
                //------------create my object-------------//     
                $this->modelMembers->setId($this->id_member);
                $this->modelMembers->setPassword($this->newPassword);
                $membersModel = $this->modelMembers;
                //-----------------------------------------//

                //--------using my method to update the password-------------//
                $this->modelMembers->updateProfilMemberPassword($membersModel);
                //----------------------------------------------------------//

                //--Add returns success for javascript processing--//
                 $callBack["confirm"] = "success";
                //------------------------------------------------//
            
            } else {
                //--Add returns error confirm password for javascript processing--//
                $callBack["errorPasswordConfirm"] = "error";
            }   //---------------------------------------------------------------//
                  
            
            } else {
                //--Add returns error password for javascript processing--//
                $callBack["errorPasswordActuel"] = "error";
            }  //--------------------------------------------------------//
            
            
            //----returns the result of the array in JSON---//
            echo json_encode($callBack);
            //---------------------------------------------//
    }


}
 ?>