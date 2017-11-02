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
            $this->load->model('customers_model' , 'modelcustomers');
            //-------------------------------------------------------//
        }

        
        public function index()
        {
              $this->load->view('dashboard/customers.html');
        }


        public function addGroupCustomers()
        {

        //---------------------------------------FORM VALIDATION------------------------------------------------------//
   		$this->form_validation->set_rules('name_group_customers', '"name_group_customers"', 'required|min_length[3]');
    	//-----------------------------------------------------------------------------------------------------------//

   		if ($this->form_validation->run())
        {
            //-------------Create my objet--------------//
        	$this->modelcustomers->setNameGroupCustomer($this->name);
            //-----------------------------------------//
        
            $modelcustomers = $this->modelcustomers;
            $this->modelcustomers->insertGroupCustomer($modelcustomers);
            $this->index();
            
   		} else {

            $this->index();
        }


        }

}

 ?>



