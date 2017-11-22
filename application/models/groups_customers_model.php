<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Groups_customers_model extends CI_Model
    {
    	//----Attribute of group customer----//
    	private $id_group_customer;
    	private $name;
    	protected $table = "groups_customers";
    	//----------------------------------//
    	
    	// ---------------------------------------- Getters methods----------------------------------//
        public function getIdGroupCustomer()
        {
            return $this->id_group_customer;
        }

         public function getNameGroupCustomer()
        {
            return $this->name;
        }
        //-------------------------------------------------------------------------------------------//

        
        // ---------------------------------------- Setters methods----------------------------------//
         public function setIdGroupCustomer($id)
        {
            return $this->id_group_customer = $id;
        }

         public function setNameGroupCustomer($name)
        {
            return $this->name = $name;
        }
        //-------------------------------------------------------------------------------------------//
       	
        
        // ----------------------------------INSERT GROUP CUSTOMERS----------------------------------//
       	public function insertGroupCustomer($model)
        {
            $name_group_customer = $model->getNameGroupCustomer();
 
            $this->db->set('name', $name_group_customer)
                     ->insert($this->table);       
        }
        //------------------------------------------------------------------------------------------//

        public function selectAll()
        {
        	$arrayGroupsCustomers = [];
            $query = $this->db->get($this->table);
            
            foreach ($query->result_object() as $ligne)
            {
                    $groupsCustomers = new Groups_customers_model();
                    $groupsCustomers->setIdGroupCustomer($ligne->id_group_customer);
                    $groupsCustomers->setNameGroupCustomer($ligne->name);
                    $arrayGroupsCustomers[] = $groupsCustomers;
            }
                    return $arrayGroupsCustomers;
        }
        //------------------------------------------------------------------------------------------//

        public function loadGrid() 
        {
       
        $query = $this->db->get($this->table);
        return $query->result_array();
        
        }
        //------------------------------------------------------------------------------------------//

        public function disableEnableOneGroupCustomer($id)
        {
            $this->db->select('actif');
            $this->db->from($this->table);
            $this->db->where('id_group_customer', $id );
            $query = $this->db->get();
            $result = $query->result_array();

            if($result[0]['actif'] == 0){
                
                $data = array ('actif' => 1 );
                $this->db->where('id_group_customer' , $id);
                $this->db->update($this->table , $data);
            } else {
                
                $data = array ('actif' => 0 );
                $this->db->where('id_group_customer' , $id);
                $this->db->update($this->table , $data);
            } 
        }
        //------------------------------------------------------------------------------------------//


    }