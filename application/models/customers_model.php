<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Customers_model extends CI_Model
    {
    	//----Attribute of group customer----//
    	private $id_group_cutomer;
    	private $name;
    	//----------------------------------//
    	
    	// ---------------------------------------- Getters methods----------------------------------//
        public function getIdGroupCustomer()
        {
            return $this->id_group_cutomer;
        }

         public function getNameGroupCustomer()
        {
            return $this->name;
        }
        //-------------------------------------------------------------------------------------------//

        
        // ---------------------------------------- Setters methods----------------------------------//
         public function setIdGroupCustomer($id)
        {
            return $this->id = $id;
        }

         public function setNameGroupCustomer($name)
        {
            return $this->name = $name;
        }
        //-------------------------------------------------------------------------------------------//
       	

       	public function insertGroupCustomer($model)
        {
            $name_group_customer = $model->getNameGroupCustomer();
            $this->db->set('name', $name_group_customer)
                     ->insert('groups_customers');       
        }


    }