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


    /*Declaration of my constructor*/
    public function __construct()
    {
        parent::__construct();
        $this->nameGroupCustomers = $this->input->post('name_group_customers');

        /*-------------------Loading model-----------------------*/
        $this->load->model('Groups_customers_model', 'modelGroupCustomers');
        $this->load->model('Customers_model', 'modelCustomers');
        /*-------------------------------------------------------*/
    }
    /*End of the declaration of my constructor*/



    /*Declaration of my default method*/
    public function index()
    {
        $this->load->view('dashboard/customers.html');
    }
    /*End of the declaration*/


    //----------------------------Method to add a client group in my database with my model----------------------------//
    public function addGroupCustomers()
    {

        //---------------------------------------FORM VALIDATION------------------------------------------------------//
        $this->form_validation->set_rules('name_group_customers', '"name_group_customers"', 'required|min_length[3]');
        //-----------------------------------------------------------------------------------------------------------//

        if ($this->form_validation->run()) {

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
    public function encodeGrid()
    {
        $results = $this->modelGroupCustomers->loadGrid();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_group_customer'], $result['name'], $result['actif']);
        }

        echo json_encode(array('data' => $data));
    }

    //----------------------------------------------------------------------------------------------------------------//


    public function changeStatusGroupCustomer()
    {
        //-------Stock in my attribute the result of the ajax post--------//
        $this->id_group_customer = $this->input->post('id');
        //----------------------------------------------------------------//
        //---Call the method of my model to delete the group in the database---//
        $this->modelGroupCustomers->disableEnableOneGroupCustomer($this->id_group_customer);
        //-----------------------------------------------------------------//

    }

    public function changeNameGroupCustomer()
    {
        //---------------------------------------FORM VALIDATION---------------------------------------------------------//
        $this->form_validation->set_rules('newNameGroupCustomer', '"New name for the group"', 'required|min_length[3]');
        //--------------------------------------------------------------------------------------------------------------//
        //---creating a array to manage ajax returns---//
        $callBack = array();
        //---------------------------------------------//

        if ($this->form_validation->run()) {
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


    public function addCustomers()
    {

      /*  $this->form_validation->set_rules('nameCustomers', '"nameCustomers"', 'required');
        $this->form_validation->set_rules('firstNameCustomers', '"firstNameCustomers"', 'required');
        $this->form_validation->set_rules('mobilPhoneNumberCustomers', '"mobilPhoneNumberCustomers"', 'required');
        $this->form_validation->set_rules('phoneNumberCustomers', '"phoneNumberCustomers"', 'required');
        $this->form_validation->set_rules('emailCustomers', '"emailCustomers"', 'required');
        $this->form_validation->set_rules('addressCustomers', '"addressCustomers"', 'required');
        $this->form_validation->set_rules('codePostalCustomers', '"codePostalCustomers"', 'required');
        $this->form_validation->set_rules('cityCustomers', '"cityCustomers"', 'required');
        $this->form_validation->set_rules('nameGroupForCustomers', '"nameGroupForCustomers"', 'required');*/



       /* if ($this->form_validation->run())
        {*/

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
            $this->modelCustomers->SetFirstName($this->firstNameCustomers);
            $this->modelCustomers->setLastName($this->nameCustomers);
            $this->modelCustomers->setMobilPhoneNumber($this->mobilPhoneCustomers);
            $this->modelCustomers->setPhoneNumber($this->phoneNumberCustomers);
            $this->modelCustomers->setMail($this->emailCustomers);
            $this->modelCustomers->setAddress($this->addressCustomers);
            $this->modelCustomers->setZipCode($this->codePostalCustomers);
            $this->modelCustomers->setCity($this->cityCustomers);
            $this->modelCustomers->setIdGroupCustomer($this->nameGroupForCustomers);
            /*-------------------------------------------------------------------------------*/

            $customerModel = $this->modelCustomers;

            $this->modelCustomers->insertOneCustomers($customerModel);


      /*  } else {


            TODO CALL BACK Json FOR ERROR IN FRONT INTERFACE

        }*/


    }

}


?>
