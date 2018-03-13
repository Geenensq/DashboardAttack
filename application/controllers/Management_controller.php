<?php
/**
 * Dashboard Attack, command manager
 * management_controller.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

class Management_controller extends CI_Controller
{
    // =======================================================================//
    // !                  Declaration of my attributes                       //
    // ======================================================================//
    private $id_member;
    private $login;
    private $password;
    private $password_confirm;
    private $email;
    private $id_group_member;
    private $id_method_shipping;
    private $name_method_shipping;
    private $price_method_shipping;

    // =======================================================================//
    // !                  Constructor of my Class                            //
    // ======================================================================//
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Members_model', 'modelMembers');
        $this->load->model('Groups_members_model', 'modelGroupsMembers');
        $this->load->model('Shipping_model', 'modelShipping');
        $this->load->helper('password');

    }

    // =======================================================================//
    // !                         Default method                              //
    // ======================================================================//
    public function index()
    {
        if ($this->session->userdata('id_member')) {

            if ($this->session->userdata('id_member') != 1) {
                $data = $this->modelGroupsMembers->selectAll();
                $array = [];
                $array['groups_members'] = $data;
                $this->load->view('dashboard/management.html', $array);

            } else {
                $this->load->view('errors/html/error_403.php');
            }

        } else {
            redirect(array('login_controller', 'index'));
        }

    }

    // =======================================================================//
    // !                   Method for send members on datatable               //
    // ======================================================================//
    public function encodeGridMembers()
    {
        $results = $this->modelMembers->loadMembersDatatable();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_member'], $result['login'], $result['actif'], $result['email'], $result['id_group_member'], $result['name']);
        }

        echo json_encode(array('data' => $data));
    }

    // =======================================================================//
    // !                   Method for send members on datatable               //
    // ======================================================================//
    public function encodeGriShipping()
    {
        $results = $this->modelShipping->loadShippingsDatatable();
        $data = array();

        foreach ($results as $result) {
            $data[] = array($result['id_method_shipping'], $result['name_method_shipping'], $result['price_method_shipping'], $result['actif']);
        }

        echo json_encode(array('data' => $data));
    }

    // ==========================================================================================//
    // !                   Method get all informations of members for modal                      //
    // ==========================================================================================//
    public function getInfosMembersModal()
    {
        $this->id_member = $this->input->post('id');
        $return = $this->modelMembers->selectAllMembersForModal($this->id_member);
        echo json_encode($return);
    }

    // ==========================================================================================//
    // !                   Method get all informations of members for modal                      //
    // ==========================================================================================//
    public function changeInfosMembersModal()
    {
        $this->form_validation->set_rules('id_member', '" "', 'required');
        $this->form_validation->set_rules('login_member', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('email_member', '" "', 'required|valid_email|min_length[3]');
        $this->form_validation->set_rules('new_group_member', '" "', 'required');

        if ($this->form_validation->run()) {
            $this->id_member = $this->input->post('id_member');
            $this->login = $this->input->post('login_member');
            $this->email = $this->input->post('email_member');
            $this->id_group_member = $this->input->post('new_group_member');

            $this->modelMembers->setId($this->id_member);
            $this->modelMembers->setLogin($this->login);
            $this->modelMembers->setEmail($this->email);
            $this->modelMembers->SetIdGroupMember($this->id_group_member);
            $this->modelMembers->setActif(1);
            $membersModel = $this->modelMembers;
            $this->modelMembers->updateMembersModal($membersModel);

            $callBack["confirm"] = "success";
            echo json_encode($callBack);
        } else {

            $callBack["confirm"] = "error";
            echo json_encode($callBack);

        }

    }

    // =======================================================================//
    // !                Method for send shippings method on modal             //
    // ======================================================================//

    public function getInfosShippingModal()
    {
        $this->id_method_shipping = $this->input->post('id');
        $return = $this->modelShipping->selectAllShippingsForModal($this->id_method_shipping);
        echo json_encode($return);
    }

    // ==========================================================================================//
    // !                         Method for change password in the modal                         //
    // ==========================================================================================//
    public function changePasswordMembers()
    {
        $this->form_validation->set_rules('password_member', '" "', 'required|min_length[3]');
        $this->form_validation->set_rules('password_member_confirmation', '" "', 'required|min_length[3]');

        if ($this->form_validation->run()) {
            $this->id_member = $this->input->post('id_member_password');
            $this->password = $this->input->post('password_member');
            $this->password_confirm = $this->input->post('password_member_confirmation');

            if ($this->password === $this->password_confirm) {
                $this->modelMembers->setId($this->id_member);

                $this->modelMembers->setPassword(hash_password($this->password));
                $membersModel = $this->modelMembers;
                $this->modelMembers->updatePasswordMembers($membersModel);

                $callBack["confirm"] = "success";
                echo json_encode($callBack);
            } else {
                $callBack["errorPasswordConfirm"] = "error";
                echo json_encode($callBack);
            }

        } else {
            $this->index();
        }

    }

    // =======================================================================//
    // !          Method for activate or desactivate group of colors         //
    // ======================================================================//
    public function changeStatusMembers()
    {
        $this->id_member = $this->input->post('id');
        $this->modelMembers->disableEnableOneMember($this->id_member);
    }

    // ==========================================================================================//
    // !                    Method for activate or desactivate shipping methods                 //
    // ==========================================================================================//
    public function changeStatusShippingsMethods()
    {
        $this->id_method_shipping = $this->input->post('id');
        $this->modelShipping->disableEnableOneShippingMethod($this->id_method_shipping);
    }

    // =======================================================================//
    // !                        Method add an method shipping                 //
    // ======================================================================//
    public function addShippingMethod()
    {

        $this->form_validation->set_rules('name_method_shipping', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('price_method_shipping', '" "', 'required|min_length[1]|numeric');

        $callBack = array();

        if ($this->form_validation->run()) {

            $this->name_method_shipping = $this->input->post('name_method_shipping');
            $this->price_method_shipping = $this->input->post('price_method_shipping');

            $this->modelShipping->setNameMethodShipping($this->name_method_shipping);
            $this->modelShipping->setPriceMethodShipping($this->price_method_shipping);
            $shippingModel = $this->modelShipping;
            $this->modelShipping->insertMethodShipping($shippingModel);

            $callBack["confirm"] = "success";

        } else {
            $callBack["confirm"] = "error";
        }

        echo json_encode($callBack);

    }

    // ==========================================================================================//
    // !                    Method for change informations of size for modal                     //
    // ==========================================================================================//

    public function editShippingsMethods()
    {

        $this->form_validation->set_rules('new_name_method_shipping', '" "', 'required|min_length[1]');
        $this->form_validation->set_rules('new_price_method_shipping', '" "', 'required|min_length[1]|numeric');
        $this->form_validation->set_rules('id_method_shipping', '" "', 'required|min_length[1]');

        $callBack = array();

        if ($this->form_validation->run()) {
            $this->modelShipping->setNameMethodShipping($this->input->post('new_name_method_shipping'));
            $this->modelShipping->setPriceMethodShipping($this->input->post('new_price_method_shipping'));
            $this->modelShipping->setIdMethodShipping($this->input->post('id_method_shipping'));

            $shippingModel = $this->modelShipping;

            $this->modelShipping->updateMethodsShippings($shippingModel);
            $callBack["confirm"] = "success";

        } else {

            $callBack["confirm"] = "error";
        }

        echo json_encode($callBack);
    }

}
