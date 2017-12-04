<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Customers_model extends CI_Model
    {
        //-----------------------------------------//
        private $table="customers";
        private $id_customer;
        private $firstname;
        private $lastname;
        private $mobil_phone;
        private $phone_number;
        private $mail;
        private $adress;
        private $zip_code;
        private $city;
        private $id_group_customer;
        private $test;

        //---------------------------------------//

    //------------------Getters------------------//
    public function getTable()
    {
        return $this->table;
    }

    public function getIdCustomer()
    {
        return $this->id_customer;
    }
   public function getFirstname()
    {
        return $this->firstname;
    }
    public function getLastname()
    {
        return $this->lastname;
    }

    public function getMobilPhone()
    {
        return $this->mobil_phone;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function getAdress()
    {
        return $this->adress;
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

    //-------------------------------------------//

    //------------------Setters------------------//
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

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }


    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }


    public function setMobilPhone($mobil_phone)
    {
        $this->mobil_phone = $mobil_phone;

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

    public function setAdress($adress)
    {
        $this->adress = $adress;

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

    //-------------------------------------------//
    
}