<?php 
Class Customers_controller extends CI_Controller
{
    //--------------Declarations of attributes-------------//
    private $name;
    private $id_group_customer;
    //-----------------------------------------------------//

        public function __construct()
        {
            parent::__construct();
            $this->name = $this->input->post('name_group_customers');
            //-------------------Loading model-----------------------//
            $this->load->model('Groups_customers_model' , 'modelGroupCustomers');
            //-------------------------------------------------------// 
        }

        
        //-------------Default called method for load my base view--------------//
        public function index()
        {       
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
            $this->modelGroupCustomers->setNameGroupCustomer($this->name);
            //-----------------------------------------//
            
            //---Call the method of my model to add the group in the database---//
            $this->modelGroupCustomers->insertGroupCustomer($this->modelGroupCustomers);
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

   
    //---------------------------------method to send the result in json to datatable --------------------------------//
       public function encodeGrid() {
            $results = $this->modelGroupCustomers->loadGrid();
            $data = array();

            foreach ($results  as $result) {
                $data[] = array($result['id_group_customer'],$result['name'],$result['actif']);
            }
     
            echo json_encode(array('data' => $data));
        }
    //----------------------------------------------------------------------------------------------------------------//


        public function changeStatusGroupCustomer(){
            //-------Stock in my attribute the result of the ajax post--------//
            $this->id_group_customer = $this->input->post('id');
            //----------------------------------------------------------------//
            //---Call the method of my model to delete the group in the database---//
            $this->modelGroupCustomers->disableEnableOneGroupCustomer($this->id_group_customer);
            //-----------------------------------------------------------------//

        } 

        public function changeNameGroupCustomer(){
            //---------------------------------------FORM VALIDATION---------------------------------------------------------//
            $this->form_validation->set_rules('newNameGroupCustomer', '"New name for the group"', 'required|min_length[3]');
            //--------------------------------------------------------------------------------------------------------------// 
            //---creating a array to manage ajax returns---//
             $callBack = array();
            //---------------------------------------------//
            
            if ($this->form_validation->run())
            {
                //---------------------------------------------------------------------------------------------//
                $this->modelGroupCustomers->setIdGroupCustomer($this->input->post('idGroupCustomer'));
                $this->modelGroupCustomers->setNameGroupCustomer($this->input->post('newNameGroupCustomer'));
                //---------------------------------------------------------------------------------------------//
                $groupMembersModel = $this->modelGroupCustomers;
                $this->modelGroupCustomers->updateNameGroupById($groupMembersModel);
                //--------------------------------------------------------------------------------------------//
                //--Add returns success for javascript processing--//
                $callBack["confirm"] = "success";
                //------------------------------------------------//
            } else {
                $callBack["errorNewNameGroup"] = "error";
            } 
            
            //----returns the result of the array in JSON---//
            echo json_encode($callBack);
            //---------------------------------------------//       
        }


        public function addCustomers(){
            /*DO IT*/
        }

}


 ?>
