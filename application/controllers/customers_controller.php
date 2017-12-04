<?php 
Class Customers_controller extends CI_Controller
{
    /*Attributes groups customers declaration*/
    private $nameGroupCustomers;
    private $id_group_customer;
    /*End of declaration for group customers*/

    /*Attributes customers declaration */
    private $nameCustomers;
    private $firstNameCustomers;
    private $mobilPhoneCustomers;
    private $phoneNumberCustomers;
    private $emailCustomers;
    private $addressCustomers;
    private $codePostalCustomers;
    private $cityCustomers;
    private $nameGroupForCustomers;
    /*End of declaration for customers*/



        public function __construct()
        {
            parent::__construct();
            $this->nameGroupCustomers = $this->input->post('name_group_customers');

            /*-------------------Loading model-----------------------*/
            $this->load->model('Groups_customers_model' , 'modelGroupCustomers');
            $this->load->model('Customers_model' , 'modelCustomers');
            /*-------------------------------------------------------*/
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
            $this->modelGroupCustomers->setNameGroupCustomer($this->nameGroupCustomers);
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

            /*Form validation configuration*/
            $this->form_validation->set_rules('nameCustomers', '"nameCustomers"', 'required');
            $this->form_validation->set_rules('firstNameCustomers', '"firstNameCustomers"', 'required');
            $this->form_validation->set_rules('mobilPhoneNumberCustomers', '"mobilPhoneNumberCustomers"', 'required');
            $this->form_validation->set_rules('phoneNumberCustomers', '"phoneNumberCustomers"', 'required');
            $this->form_validation->set_rules('emailCustomers', '"emailCustomers"', 'required');
            $this->form_validation->set_rules('addressCustomers', '"addressCustomers"', 'required');
            $this->form_validation->set_rules('codePostalCustomers', '"codePostalCustomers"', 'required');
            $this->form_validation->set_rules('cityCustomers', '"cityCustomers"', 'required');
            $this->form_validation->set_rules('nameGroupForCustomers', '"nameGroupForCustomers"', 'required');
            /*End of configuration*/



            if ($this->form_validation->run())
            {
                $this->nameCustomers = $this->input->post('nameCustomers');
                $this->firstNameCustomers = $this->input->post('firstNameCustomers');
                $this->mobilPhoneCustomers = $this->input->post('mobilPhoneNumberCustomers');
                $this->phoneNumberCustomers = $this->input->post('phoneNumberCustomers');
                $this->emailCustomers = $this->input->post('emailCustomers');
                $this->addressCustomers = $this->input->post('addressCustomers');
                $this->codePostalCustomers = $this->input->post('codePostalCustomers');
                $this->cityCustomers = $this->input->post('cityCustomers');
                $this->nameGroupForCustomers = $this->input->post('nameGroupForCustomers');

                /* ----------------------------Create my object----------------------------------*/
                $this->modelMembers->SetFirstName($this->nameCustomers);
                $this->modelMembers->setLastName($this->firstNameCustomers);
                $this->modelMembers->setMobilPhoneNumber($this->mobilPhoneCustomers);
                $this->modelMembers->setPhoneNumber($this->phoneNumberCustomers);
                $this->modelMembers->setMail($this->emailCustomers);
                $this->modelMembers->setAddress($this->addressCustomers);
                $this->modelMembers->setZipCode($this->codePostalCustomers);
                $this->modelMembers->setCity($this->cityCustomers);
                $this->modelMembers->setIdGroupCustomer($this->nameGroupForCustomers);
                /*-------------------------------------------------------------------------------*/

                $customerModel = $this->modelCustomers;
                $this->modelCustomers->insertOneCustomers($customerModel);


            } else {

                /*TODO CALL BACK Json FOR ERROR IN FRONT INTERFACE*/

            }





        }

}


 ?>
