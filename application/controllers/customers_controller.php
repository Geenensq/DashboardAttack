<?php
/**
 * Dashboard Attack, command manager
 * customers_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

Class Customers_controller extends CI_Controller
{
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//

    /*Attributes groups customers declaration*/
    private $nameGroupCustomers;
    private $id_group_customer;

    /*Attributes customers declaration */
    private $id_customer;
    private $nameCustomers;
    private $firstNameCustomers;
    private $mobilPhoneCustomers;
    private $phoneNumberCustomers;
    private $emailCustomers;
    private $addressCustomers;
    private $codePostalCustomers;
    private $cityCustomers;
    private $nameGroupForCustomers;


// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//
    public function __construct()
    {
        parent::__construct();
        $this->nameGroupCustomers = $this->input->post('name_group_customers');
        $this->load->model('Groups_customers_model', 'modelGroupCustomers');
        $this->load->model('Customers_model', 'modelCustomers');
    }

// =======================================================================//
// !                         Default method                              //
// ======================================================================//
    public function index()
    {
        //-----object array that contains the customers groups-----//
        $data = $this->modelGroupCustomers->selectAll();
        //---------------------------------------------------------//
        $array = [];
        $array['groups'] = $data;
        $this->load->view('dashboard/customers.html' , $array);
    }


// =======================================================================//
// !                  Method for add an group of customers                //
// ======================================================================//
    public function addGroupCustomers()
    {
        /*Declaration of the rules of my form*/
        $this->form_validation->set_rules('name_group_customers', '"name_group_customers"', 'required|min_length[3]');

        if ($this->form_validation->run()) {
            $callBack = array();
            $this->modelGroupCustomers->setNameGroupCustomer($this->nameGroupCustomers);
            $this->modelGroupCustomers->insertGroupCustomer($this->modelGroupCustomers);

            $callBack["confirm"] = "success";

        } else {
            $callBack["confirm"] = "error";
        }
        echo json_encode($callBack);
    }

// =======================================================================//
// !            Method for send groups customers on datatables        //
// ======================================================================//
    public function encodeGridGroupsCustomers()
    {
        $results = $this->modelGroupCustomers->loadDataGroupsCustomersDataTable();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_group_customer'], $result['name'], $result['actif']);
        }

        echo json_encode(array('data' => $data));
    }


// =======================================================================//
// !            Method for send groups customers on datatable         //
// ======================================================================//
    public function encodeGridCustomers()
    {
        $results = $this->modelCustomers->loadDataCustomersDataTable();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_customer'], $result['lastname'], $result['firstname'], $result['mobil_phone_number'],
            $result['phone_number'], $result['mail'], $result['address'], $result['zip_code'], $result['city'], $result['group_name'], $result['actif']);
        }

        echo json_encode(array('data' => $data));
    }

// =======================================================================//
// !      Method for activate or desactivate and group of customers      //
// ======================================================================//
    public function changeStatusGroupCustomer()
    {
        $this->id_group_customer = $this->input->post('id');
        $this->modelGroupCustomers->disableEnableOneGroupCustomer($this->id_group_customer);
    }

// =======================================================================//
// !      Method for activate or desactivate customers                   //
// ======================================================================//
    public function changeStatusCustomer()
    {
        $this->id_customer = $this->input->post('id');
        $this->modelCustomers->disableEnableOneCustomer($this->id_customer);
    }


// =======================================================================//
// !            Method UPDATE an group of customers on modal             //
// ======================================================================//
    public function changeNameGroupCustomer()
    {
        $this->form_validation->set_rules('new_name_group_customer', '" "', 'required|min_length[3]');
        $callBack = array();

        if ($this->form_validation->run()) {
            $this->modelGroupCustomers->setIdGroupCustomer($this->input->post('id_group_customer'));
            $this->modelGroupCustomers->setNameGroupCustomer($this->input->post('new_name_group_customer'));

            $groupMembersModel = $this->modelGroupCustomers;
            $this->modelGroupCustomers->updateNameGroupById($groupMembersModel);
            $callBack["confirm"] = "success";
        } else {
            $callBack["errorNewNameGroup"] = "error";
        }

        echo json_encode($callBack);
    }


// =======================================================================//
// !                 Method UPDATE an customers on modal                 //
// ======================================================================//
    public function changeInformationsCustomer()
    {
        $this->form_validation->set_rules('id_customer', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_name_customer', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('new_firstname_customer', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('new_mobil_phone_customer', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('new_phone_customer', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('new_mail_customer', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('new_address_customer', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('new_cp_group_customer', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('new_city_customer', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_group_customer', '" "', 'required|min_length[3]');
        
        $callBack = array();

        if ($this->form_validation->run()) {

            $this->modelCustomers->setIdCustomer($this->input->post('id_customer'));
            $this->modelCustomers->setFirstName($this->input->post('new_firstname_customer'));
            $this->modelCustomers->setLastName($this->input->post('new_name_customer'));
            $this->modelCustomers->setMobilPhoneNumber($this->input->post('new_mobil_phone_customer'));
            $this->modelCustomers->setPhoneNumber($this->input->post('new_phone_customer'));
            $this->modelCustomers->setMail($this->input->post('new_mail_customer'));
            $this->modelCustomers->setAddress($this->input->post('new_address_customer'));
            $this->modelCustomers->setZipCode($this->input->post('new_cp_group_customer'));
            $this->modelCustomers->setCity($this->input->post('new_city_customer'));
            $this->modelCustomers->setIdGroupCustomer($this->input->post('new_group_customer'));
            $MembersModel = $this->modelCustomers;
            
            $this->modelCustomers->updateOneCustomers($MembersModel);
            $callBack["confirm"] = "success";
        } else {
            $callBack["errorNewNameGroup"] = "error";
        }

       /* echo json_encode($callBack);*/
    }

// =======================================================================//
// !                       Method add an customers                       //
// ======================================================================//
    public function addCustomers()
    {
        /*Declaration of the rules of my form*/
        $this->form_validation->set_rules('name_customers', '"name_customers"', 'required');
        $this->form_validation->set_rules('first_name_customers', '"first_name_customers"', 'required');
        $this->form_validation->set_rules('mobil_phone_number_customers', '"mobil_phone_number_customers"', 'required');
        $this->form_validation->set_rules('phone_number_customers', '"phone_number_customers"', 'required');
        $this->form_validation->set_rules('email_customers', '"email_customers"', 'required');
        $this->form_validation->set_rules('address_customers', '"address_customers"', 'required');
        $this->form_validation->set_rules('code_postal_customers', '"code_postal_customers"', 'required');
        $this->form_validation->set_rules('city_customers', '"city_customers"', 'required');
        $this->form_validation->set_rules('name_group_for_customers', '"name_group_for_customers"', 'required');
        /*End of my declaration*/

        $callBack = array();

        if ($this->form_validation->run()) {

            /*Retrieving my POST values ​​to store them in my attributes*/
            $this->firstNameCustomers = $this->input->post('first_name_customers');
            $this->nameCustomers = $this->input->post('name_customers');
            $this->mobilPhoneCustomers = $this->input->post('mobil_phone_number_customers');
            $this->phoneNumberCustomers = $this->input->post('phone_number_customers');
            $this->emailCustomers = $this->input->post('email_customers');
            $this->addressCustomers = $this->input->post('address_customers');
            $this->codePostalCustomers = $this->input->post('code_postal_customers');
            $this->cityCustomers = $this->input->post('city_customers');
            $this->nameGroupForCustomers = $this->input->post('name_group_for_customers');


            /* ----------------------------Create my object----------------------------------*/
            $this->modelCustomers->setFirstName($this->firstNameCustomers);
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
            $callBack["confirm"] = "success";

        } else {
            $callBack["confirm"] = "error";
        }

        echo json_encode($callBack);
    }



 }

?>
