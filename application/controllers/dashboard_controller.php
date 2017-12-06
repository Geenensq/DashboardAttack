<?php
/**
 * Dashboard Attack, command manager
 * dashboard_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */


Class Dashboard_controller extends CI_Controller
{

// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//

    public function __construct()
    {
        parent::__construct();
    }

// =======================================================================//
// !                         Default method                              //
// ======================================================================//

    public function index()
    {
        $this->load->view('dashboard/dashboard.html');
    }


}
 ?>