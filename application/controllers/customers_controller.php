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
        $this->load->model('Groups_customers_model', 'modelGroupCustomers');
        $this->load->model('Customers_model', 'modelCustomers');
    }
    /*End of the declaration of my constructor*/


    /*---Declaration of my default method---*/
    public function index()
    {
        $this->load->view('dashboard/customers.html');
    }
    /*--------End of the declaration--------*/


    /*----------------------------Method to add a client group in my database with my model---------------------------*/
    public function addGroupCustomers()
    {
        /*Declaration of the rules of my form*/
        $this->form_validation->set_rules('name_group_customers', '"name_group_customers"', 'required|min_length[3]');
        /*End of declaration*/

        if ($this->form_validation->run()) {

            $callBack = array();

            /*Call my method and my setters in my model for insert an group customers*/
            $this->modelGroupCustomers->setNameGroupCustomer($this->nameGroupCustomers);
            $this->modelGroupCustomers->insertGroupCustomer($this->modelGroupCustomers);
            /*End*/

            $callBack["confirm"] = "success";

        } else {

            $callBack["confirm"] = "error";
        }

        /*Send json flux for my javascript*/
        echo json_encode($callBack);
        /*End*/
    }
    /*----------------------------------------------------------------------------------------------------------------*/


    /*---------------------------------method to send the result in json to datatable --------------------------------*/
    public function encodeGrid()
    {
        $results = $this->modelGroupCustomers->loadGrid();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_group_customer'], $result['name'], $result['actif']);
        }

        echo json_encode(array('data' => $data));
    }
    /*----------------------------------------------------------------------------------------------------------------*/


    public function changeStatusGroupCustomer()
    {
        /*-------Stock in my attribute the result of the ajax post--------*/
        $this->id_group_customer = $this->input->post('id');
        /*----------------------------------------------------------------*/

        /*---Call the method of my model to delete the group in the database---*/
        $this->modelGroupCustomers->disableEnableOneGroupCustomer($this->id_group_customer);
        /*--------------------------------------------------------------------*/

    }

    public function changeNameGroupCustomer()
    {
        /*Declaration of the rules of my form*/
        $this->form_validation->set_rules('newNameGroupCustomer', '"New name for the group"', 'required|min_length[3]');
        /*End of my declaration*/

        /*---creating a array to manage ajax returns---*/
        $callBack = array();
        /*---------------------------------------------*/

        if ($this->form_validation->run()) {

            /*Retrieving my POST values ​​to store them in my attributes*/
            $this->modelGroupCustomers->setIdGroupCustomer($this->input->post('idGroupCustomer'));
            $this->modelGroupCustomers->setNameGroupCustomer($this->input->post('newNameGroupCustomer'));
            /*End of retrieving*/

            $groupMembersModel = $this->modelGroupCustomers;

            /*Call my method in my model for insert an customers*/
            $this->modelGroupCustomers->updateNameGroupById($groupMembersModel);

            /*Add returns success for javascript processing*/
            $callBack["confirm"] = "success";
            /*End*/

        } else {
            /*Add returns error for javascript processing*/
            $callBack["errorNewNameGroup"] = "error";
            /*End*/
        }

        /*---returns the result of the array in JSON---*/
        echo json_encode($callBack);
        /*---------------------------------------------*/
    }


    public function addCustomers()
    {
        /*Declaration of the rules of my form*/
        $this->form_validation->set_rules('nameCustomers', '"nameCustomers"', 'required');
        $this->form_validation->set_rules('firstNameCustomers', '"firstNameCustomers"', 'required');
        $this->form_validation->set_rules('mobilPhoneNumberCustomers', '"mobilPhoneNumberCustomers"', 'required');
        $this->form_validation->set_rules('phoneNumberCustomers', '"phoneNumberCustomers"', 'required');
        $this->form_validation->set_rules('emailCustomers', '"emailCustomers"', 'required');
        $this->form_validation->set_rules('addressCustomers', '"addressCustomers"', 'required');
        $this->form_validation->set_rules('codePostalCustomers', '"codePostalCustomers"', 'required');
        $this->form_validation->set_rules('cityCustomers', '"cityCustomers"', 'required');
        $this->form_validation->set_rules('nameGroupForCustomers', '"nameGroupForCustomers"', 'required');
        /*End of my declaration*/


        if ($this->form_validation->run()) {
            /*Retrieving my POST values ​​to store them in my attributes*/
            $this->nameCustomers = $this->input->post('nameCustomers');
            $this->firstNameCustomers = $this->input->post('firstNameCustomers');
            $this->mobilPhoneCustomers = $this->input->post('mobilPhoneNumberCustomers');
            $this->phoneNumberCustomers = $this->input->post('phoneNumberCustomers');
            $this->emailCustomers = $this->input->post('emailCustomers');
            $this->addressCustomers = $this->input->post('addressCustomers');
            $this->codePostalCustomers = $this->input->post('codePostalCustomers');
            $this->cityCustomers = $this->input->post('cityCustomers');
            $this->nameGroupForCustomers = $this->input->post('nameGroupForCustomers');
            /*End of retrieving*/

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

            /*Call my method in my model for insert an customers*/
            $this->modelCustomers->insertOneCustomers($customerModel);
            /*End*/
        }


    }

}


?>
