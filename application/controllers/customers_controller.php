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
        $this->load->view('dashboard/customers.html');
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
// !            Method for display groups customers on dataables         //
// ======================================================================//
    public function encodeGrid()
    {
        $results = $this->modelGroupCustomers->loadGrid();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_group_customer'], $result['name'], $result['actif']);
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
// !                Method rename an group of customers                  //
// ======================================================================//
    public function changeNameGroupCustomer()
    {
        $this->form_validation->set_rules('new_name_group_customer', '"New name for the group"', 'required|min_length[3]');
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
// =======================================================================//
// !       Method GET GROUPS CUSTOMERS FOR AUTOCOMPLETE FUNCTION          //
// ======================================================================//

    public function fetch()
    {

    define ("DB_USER", "root");
    define ("DB_PASSWORD", "");
    define ("DB_DATABASE", "testdb");
    define ("DB_HOST", "localhost");

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    $sql = "SELECT name FROM groups_customers WHERE name LIKE '%".$_GET['query']."%' LIMIT 10";
    $result = $mysqli->query($sql);
    
    $json = [];
    while($row = $result->fetch_assoc()){
         $json[] = $row['name'];
    }

    echo json_encode($json);



}

 }

?>
