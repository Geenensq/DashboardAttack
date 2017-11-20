<?php 
Class Customers_controller extends CI_Controller
{
    //--------------Declarations of attributes-------------//
    private $name;
    //-----------------------------------------------------//

        public function __construct()
        {
            parent::__construct();
            $this->name = $this->input->post('name_group_customers');
            
            //-------------------Loading model-----------------------//
            $this->load->model('Groups_customers_model' , 'modelcustomers');
            //-------------------------------------------------------//
            $this->load->library('ssp');

        }

        
        public function index()
        {     
              $listGroupCustomers = $this->modelcustomers->selectAll();   
              $this->load->view('dashboard/customers.html');
        }

        public function addGroupCustomers()
        {
        //---------------------------------------FORM VALIDATION------------------------------------------------------//
        $this->form_validation->set_rules('name_group_customers', '"name_group_customers"', 'required|min_length[3]');
        //-----------------------------------------------------------------------------------------------------------//

        if ($this->form_validation->run())
        {

            $callBack = array();
            //-------------Create my objet--------------//
            $this->modelcustomers->setNameGroupCustomer($this->name);
            //-----------------------------------------//
            
            $modelcustomers = $this->modelcustomers;
            $this->modelcustomers->insertGroupCustomer($modelcustomers);
            $callBack["confirm"] = "success";
            
        } else {

            $callBack["confirm"] = "error";
        }

        //----------------------------------------------------------------------------------------------------//
            echo json_encode($callBack);
        //---------------------------------------------------------------------------------------------------//
    }


    public function testAjax()
    {
        // DB table to use
        $table = 'groups_customers';

        // Table's primary key
        $primaryKey = 'id_group_customer';

        // indexes
        // on map les champs de la base de donnée (index db) correspondant aux col de la datatable ( index dt)
        $columns = array(
            array( 'db' => 'id_group_customer','dt' => 0 ),
            array( 'db' => 'name','dt' => 1 ),
            
        );
        

        $sql_details = array('user' => 'root','pass' => '','db'   => 'testdb','host' => '127.0.0.1');
        header('Content-Type: application/json');
        echo json_encode(
        ssp::simple($_GET, $sql_details, $table, $primaryKey, $columns ));
    }

}

 ?>
