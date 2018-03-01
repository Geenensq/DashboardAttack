<?php
/**
 * Dashboard Attack, command manager
 * profil_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */


Class Profil_controller extends CI_Controller
{
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    private $id_member;
    private $password;
    private $newPassword;
    private $newPasswordConfirm;
    private $email;

// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//
    public function __construct()
    {
        parent::__construct();
        $this->load->model('members_model', 'modelMembers');
        $this->load->model('Groups_members_model', 'GroupsMembersModel');
        $this->id_member = $this->session->userdata('id_member');
    }

// =======================================================================//
// !                         Default method                              //
// ======================================================================//
    public function index()
    {
        if($this->session->userdata('id_member')){
            //-----Get all informations of my user and group user-----//
         $infosUser = $this->modelMembers->getOne($this->id_member);
            //---Load my view profil and give an array associativ with my variable infouser---//
         $this->load->view('dashboard/profil.html', array('infosUser' => $infosUser), false);

     }else{
        redirect(array('login_controller', 'index'));
    }

}



// =======================================================================//
// !                  Method for edit email profil members               //
// ======================================================================//

public function editEmailProfil()
{
    $this->form_validation->set_rules('email', '"Email adress"', 'required|valid_email|min_length[1]');

    if ($this->form_validation->run()) {
            //-----Get my adress mail of my input-----//
        $this->email = $this->input->post('email');
            //---------------------------------------//

            //-------------Create my objet--------------//
        $this->modelMembers->setId($this->id_member);
        $this->modelMembers->setEmail($this->email);
            //-----------------------------------------//

        $membersModel = $this->modelMembers;
        $this->modelMembers->updateEmailMember($membersModel);

        $this->index();

    } else {
        $this->index();
    }
}


// =======================================================================//
// !                  Method for edit password members                   //
// ======================================================================//

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

    $callBack = array();

        //--If the method returns true--//
    if ($resultRequest) {

            //---------if the 2 passwords are the same----------//
        if ($this->newPasswordConfirm == $this->newPassword) {

                //------------create my object-------------//
            $this->modelMembers->setId($this->id_member);
            $this->modelMembers->setPassword($this->newPassword);
            $membersModel = $this->modelMembers;
                //-----------------------------------------//

                //--------using my method to update the password-------------//
            $this->modelMembers->updatePasswordMember($membersModel);
                //----------------------------------------------------------//

            $callBack["confirm"] = "success";

        } else {
            $callBack["errorPasswordConfirm"] = "error";
        }

    } else {
        $callBack["errorPasswordActuel"] = "error";
    }


    echo json_encode($callBack);
}
    //----------------------------------------------------------------------------------------//


}

?>