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
            
            //-------Loadid library for datatables--------//
            $this->load->library('ssp');
            //-------------------------------------------//
        }

        
        //-------------Default called method for load my base view--------------//
        public function index()
        {     
              $listGroupCustomers = $this->modelcustomers->selectAll();   
              $this->load->view('dashboard/customers.html');


        }
        //---------------------------------------------------------------------//


        //----------------------------Method to add a client group in my database with my model----------------------------//
        public function addGroupCustomers()
        {
        
        //---------------------------------------FORM VALIDATION------------------------------------------------------//
        $this->form_validation->set_rules('name_group_customers', '"name_group_customers"', 'required|min_length[3]');
        //-----------------------------------------------------------------------------------------------------------//

        if ($this->form_validation->run())
        {

            //---creating a array to manage ajax returns---//
            $callBack = array();
            //---------------------------------------------//
            
            //-------------Create my objet--------------//
            $this->modelcustomers->setNameGroupCustomer($this->name);
            //-----------------------------------------//
            
            //---Call the method of my model to add the group in the database---//
            $modelcustomers = $this->modelcustomers;
            $this->modelcustomers->insertGroupCustomer($modelcustomers);
            //-----------------------------------------------------------------//


            //--Add returns success for javascript processing--//
            $callBack["confirm"] = "success";
            //-------------------------------------------------//

        } else {

            //--Add returns error for javascript processing--//
            $callBack["confirm"] = "error";
            //------------------------------------------------//
        }

            //----returns the result of the array in JSON---//
            echo json_encode($callBack);
            //---------------------------------------------//
    }

    //----------------------------------------------------------------------------------------------------------------//


    public function testAjax()
    {
        // DB table to use
        $table = 'groups_customers';
        // Table's primary key
        $primaryKey = 'id_group_customer';

        //---on map les champs de la base de donnée (index db) correspondant aux col de la datatable ( index dt)---//
        $columns = array(array( 'db' => 'id_group_customer','dt' => 0 ),array( 'db' => 'name','dt' => 1 ),);
        //---------------------------------------------------------------------------------------------------------//

        $sql_details = array('user' => 'root','pass' => '','db'   => 'testdb','host' => '127.0.0.1');

        header('Content-Type: application/json');
        echo json_encode(
        ssp::simple($_GET, $sql_details, $table, $primaryKey, $columns ));
    }




   public function get_json() {
        $this->load->model('Groups_customers_model');
        $results = $this->Groups_customers_model->load_grid();


        $data = array();

        foreach ($results  as $result) {
            array_push($data, array(
                $result['id_group_customer'],
                $result['name'],
                
                /*anchor('test/view/' . $result['id_group_customer'], 'View'),
                anchor('test/edit/' . $result['id_group_customer'], 'Edit')*/
            
            ));
        }
 
        echo json_encode(array('data' => $data));
    }





}



 




 ?>
