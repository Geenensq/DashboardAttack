<?php 


Class Session_controller extends CI_Controller
{

	public function index()
    {
       $this->session->sess_destroy();
       redirect(array('login_controller', 'index')); 
    }


}

 ?>