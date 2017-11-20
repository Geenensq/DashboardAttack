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
            $this->load->library('SspDatatable');

        }

        
        public function index()
        {     
              $listGroupCustomers = $this->modelcustomers->selectAll();   
              $this->load->view('dashboard/customers.html', array('listGroupCustomers' => $listGroupCustomers) , false);
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


    public function testAjax(){
        // DB table to use
        $table = 'groups_customers';

        // Table's primary key
        $primaryKey = 'id_group_customer';

        // indexes
        // on map les champs de la base de donnÃ©s (index db) correspondant aux col de la datatable ( index dt)
        $columns = array(
            array( 'db' => 'id_group_customer',             'dt' => 0 ),
            array( 'db' => 'name',        'dt' => 1 ),
        );

        $this->sspDatatable->simple($_GET, array('DB_HOST' => '127.0.0.1', 'DB_LOGIN' => 'root', 'DB_PSW' => '', 'DB_NAME' => 'testdb', 'DB_PORT' => '3306'), $table, $primaryKey, $columns);

        return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($this->sspDatatable->simple($_GET, array('DB_HOST' => '127.0.0.1', 'DB_LOGIN' => 'root', 'DB_PSW' => '', 'DB_NAME' => 'testdb', 'DB_PORT' => '3306'), $table, $primaryKey, $columns)));


    }


        

}

 ?>



