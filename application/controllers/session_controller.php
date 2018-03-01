<?php
/**
 * Dashboard Attack, command manager
 * session_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

Class Session_controller extends CI_Controller
{

// =======================================================================//
// !                         Default method                              //
// ======================================================================//
	public function index()
    {
       $this->session->sess_destroy();
       redirect(array('login_controller', 'index')); 
    }
}

 ?>