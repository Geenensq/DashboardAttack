<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Customers_model extends CI_Model
    {
        /*Declaration attributes of my model*/
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
        /*End of declaration*/


        /*Start my getters methods*/
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
        /*End of my getters*/

        /*Start my setters methods*/
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

        /*End of my setters methods*/


        /*Start CRUD methods*/

        public function insertOneCustomers($model){

            $firstNameCustomer = $model->getFirstName();
            $lastNameCustomer = $model->getLastname();
            $mobilPhoneCustomer = $model->getMobilPhoneNumber();
            $phoneNumberCustomer = $model ->getPhoneNumber();
            $mailCustomer = $model->getMail();
            $addressCustomer = $model->getAddress();
            $zipCodeCustomer = $model->getZipCode();
            $cityCustomer = $model->getCity();

            $this->db->set('firstname', $firstNameCustomer)
                set('lastname', $lastNameCustomer)
                set('mobil_phone_number', $mobilPhoneCustomer)
                set('phone_number', $phoneNumberCustomer)
                set('mail', $mailCustomer)
                set('address', $addressCustomer)
                set('zip_code',$zipCodeCustomer )
                set('city', $cityCustomer)
                    ->insert($this->table)
        }

        /*End CRUD methods*/
    
}