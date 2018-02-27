<?php
/**
 * Dashboard Attack, command manager
 * customers_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Customers_model extends CI_Model
    {
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
        private $table="customers";
        private $id_customer;
        private $firstName;
        private $lastName;
        private $mobil_phone_number;
        private $phone_number;
        private $mail;
        private $address;
        private $zip_code;
        private $city;
        private $id_group_customer;
        private $name_group_customer;
        private $actif;

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
        public function getTable()
        {
        return $this->table;
        }

        public function getIdCustomer()
        {
            return $this->id_customer;
        }
        public function getFirstName()
        {
            return $this->firstName;
        }
        public function getLastName()
        {
            return $this->lastName;
        }

        public function getMobilPhoneNumber()
        {
            return $this->mobil_phone_number;
        }

        public function getPhoneNumber()
        {
            return $this->phone_number;
        }
        public function getMail()
        {
            return $this->mail;
        }
        public function getAddress()
        {
            return $this->address;
        }

        public function getZipCode()
        {
            return $this->zip_code;
        }
        public function getCity()
        {
            return $this->city;
        }
        public function getIdGroupCustomer()
        {
            return $this->id_group_customer;
        }

        public function getActif()
        {
            return $this->actif;
        }

        public function getNameGroupCustomer()
        {
            return $this->name_group_customer;
        }



// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
        public function setTable($table)
        {
            $this->table = $table;

            return $this;
        }

        public function setIdCustomer($id_customer)
        {
            $this->id_customer = $id_customer;

            return $this;
        }

        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;

            return $this;
        }


        public function setLastName($lastName)
        {
            $this->lastName = $lastName;

            return $this;
        }


        public function setMobilPhoneNumber($mobil_phone_number)
        {
            $this->mobil_phone_number = $mobil_phone_number;

            return $this;
        }


        public function setPhoneNumber($phone_number)
        {
            $this->phone_number = $phone_number;

            return $this;
        }


        public function setMail($mail)
        {
            $this->mail = $mail;

            return $this;
        }

        public function setAddress($address)
        {
            $this->address = $address;

            return $this;
        }

        public function setZipCode($zip_code)
        {
            $this->zip_code = $zip_code;

            return $this;
        }

        public function setCity($city)
        {
            $this->city = $city;

            return $this;
        }

        public function setIdGroupCustomer($id_group_customer)
        {
            $this->id_group_customer = $id_group_customer;

            return $this;
        }

        public function setActif($actif)
        {
            $this->actif = $actif;
            return $this;
        }

        public function setNameGroupCustomer($name_group_customer)
        {
            $this->name_group_customer = $name_group_customer;
            return $this;
        }



// =======================================================================//
// !                     Start CRUD methods                              //
// ======================================================================//

        
// =======================================================================//
// !                 Method SELECT * groupscustomers                      //
// ======================================================================//

        public function selectAll()
        {
            $arrayCustomers = [];
            $this->db->select('*');
            $this->db->from($this->table);
            $query = $this->db->get();

            foreach ($query->result_object() as $ligne)
            {
                    $customers = new Customers_model();
                    $customers->setIdCustomer($ligne->id_customer);
                    $customers->setFirstName($ligne->firstname);
                    $customers->setLastName($ligne->lastname);
                    $arrayCustomers[] = $customers;
            }
                    return $arrayCustomers;
        }

// ======================================================================//
// !          Method for select customers for autocompletion             //
// ======================================================================//

        public function selectALLAutoComplete($search){
     
            $this->db->select('CONCAT(firstname," ",lastname) AS text, customers.id_customer AS id');
            $this->db->from($this->table);
            $this->db->like('CONCAT(firstname," ",lastname)', $search);
            $this->db->limit(10);

            $query = $this->db->get();

            $json = [];

            foreach ($query->result_object() as $row){

                $json[] = ['id'=> $row->id, 'text'=> $row->text ];
            }
            
            return $json;

        }


// =======================================================================//
// !                Method for insert on customers                       //
// ======================================================================//
        public function insertOneCustomers($model){

            $firstNameCustomer = $model->getFirstName();
            $lastNameCustomer = $model->getLastname();
            $mobilPhoneCustomer = $model->getMobilPhoneNumber();
            $phoneNumberCustomer = $model ->getPhoneNumber();
            $mailCustomer = $model->getMail();
            $addressCustomer = $model->getAddress();
            $zipCodeCustomer = $model->getZipCode();
            $cityCustomer = $model->getCity();
            $groupForCustomer = $model->getIdGroupCustomer();
            $actif = 1;

            $this->db->set('firstname', $firstNameCustomer)
                        ->set('lastname', $lastNameCustomer)
                        ->set('mobil_phone_number', $mobilPhoneCustomer)
                        ->set('phone_number', $phoneNumberCustomer)
                        ->set('mail', $mailCustomer)
                        ->set('address', $addressCustomer)
                        ->set('zip_code',$zipCodeCustomer )
                        ->set('city', $cityCustomer)
                        ->set('actif' , $actif)
                        ->set('id_group_customer', $groupForCustomer)
                        ->insert($this->table);
        }


// =======================================================================//
// !               Method SELECT * customers for datatable               //
// ======================================================================//

    public function loadDataCustomersDataTable()
    {
        $this->db->select('`id_customer`, `lastname`, `firstname`, `mobil_phone_number`, `phone_number`, `mail`, `address`, `zip_code`, `city`, `groups_customers.name` AS `group_name`, `customers.actif` AS `actif`');
        $this->db->from($this->table);
        $this->db->join('groups_customers', 'customers.id_group_customer = groups_customers.id_group_customer');
        $query = $this->db->get();
        return $query->result_array();
    }

// =======================================================================//
// !               Method UPDATE customers status                        //
// ======================================================================//

    public function disableEnableOneCustomer($id)
    {
            $this->db->select('actif');
            $this->db->from($this->table);
            $this->db->where('id_customer', $id );
            $query = $this->db->get();
            $result = $query->result_array();

            if($result[0]['actif'] == 0){

                $data = array ('actif' => 1 );
                $this->db->where('id_customer' , $id);
                $this->db->update($this->table , $data);
            } else {

                $data = array ('actif' => 0 );
                $this->db->where('id_customer' , $id);
                $this->db->update($this->table , $data);
            }


    }

// =======================================================================//
// !             Method UPDATE ALL customers informations                //
// ======================================================================//

    public function updateOneCustomers($model)
    {
        $data = array (
            'firstname' =>$model->getFirstName(),
            'lastname' =>$model->getLastName(),
            'mobil_phone_number' =>$model->getMobilPhoneNumber(),
            'phone_number' =>$model->getPhoneNumber(),
            'mail' =>$model->getMail(),
            'address' =>$model->getAddress(),
            'zip_code' =>$model->getZipCode(),
            'city' =>$model->getCity(),
            'actif' =>$model->getActif(),
            'id_group_customer'=>$this->getIdGroupCustomer()
        );


        $this->db->where('id_customer' , $model->getIdCustomer());
        $this->db->update($this->table , $data);

    }
// =======================================================================//
// !         Method SELECT ALL customers informations FOR MODAL          //
// ======================================================================//
    public function selectAllCustomersForModal($id)
    {
        $this->db->select('`id_customer`, `lastname`, `firstname`, `mobil_phone_number`, `phone_number`, `mail`, `address`, `zip_code`, `city`, `groups_customers.name` AS `group_name`, `customers.actif` AS `actif`, `customers.id_group_customer` as `id_group_customer`');
        $this->db->from($this->table);
        $this->db->join('groups_customers', 'customers.id_group_customer = groups_customers.id_group_customer');
        $this->db->where('id_customer' , $id);
        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            $customer["id_customer"] =  $row->id_customer;
            $customer["lastname"] = $row->lastname;
            $customer["firstname"] = $row->firstname;
            $customer["mobil_phone_number"] = $row->mobil_phone_number;
            $customer["phone_number"] = $row->phone_number;
            $customer["mail"] = $row->mail;
            $customer["address"] = $row->address;
            $customer["zip_code"] = $row->zip_code;
            $customer["city"] = $row->city;
            $customer["group_name"] = $row->group_name;
            $customer["actif"] = $row->actif;
            $customer["id_group_customer"] = $row->id_group_customer;
        }

        return $customer;

    }


/*-----------End CRUD methods-----------*/
    
}