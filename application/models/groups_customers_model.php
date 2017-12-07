<?php
/**
 * Dashboard Attack, command manager
 * groups_customers_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Groups_customers_model extends CI_Model
    {
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    	private $id_group_customer;
    	private $name;
    	protected $table = "groups_customers";


// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
        public function getIdGroupCustomer()
        {
            return $this->id_group_customer;
        }

         public function getNameGroupCustomer()
        {
            return $this->name;
        }

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
         public function setIdGroupCustomer($id)
        {
            return $this->id_group_customer = $id;
        }

         public function setNameGroupCustomer($name)
        {
            return $this->name = $name;
        }

// =======================================================================//
// !                     Start CRUD methods                              //
// ======================================================================//



// =======================================================================//
// !                Method for insert an group customers                 //
// ======================================================================//
       	public function insertGroupCustomer($model)
        {
            $name_group_customer = $model->getNameGroupCustomer();
 
            $this->db->set('name', $name_group_customer)
                     ->set('actif', "1")
                     ->insert($this->table);       
        }
// =======================================================================//
// !                      Method SELECT * customers                      //
// ======================================================================//

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
// =======================================================================//
// !               Method SELECT * customers for datatable               //
// ======================================================================//

        public function loadGrid() 
        {
        $query = $this->db->get($this->table);
        return $query->result_array();
        }
// =======================================================================//
// !        Method for disable and enable the groups customers           //
// ======================================================================//

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

// =======================================================================//
// !                 Method update a group by its id                     //
// ======================================================================//

        public function updateNameGroupById($model){
            $data = array ('name' =>$model->getNameGroupCustomer());
            $this->db->where('id_group_customer' , $model->getIdGroupCustomer());
            $this->db->update($this->table , $data);
        }

// =======================================================================//
// !                 Method SELECT GROUPS CUSTOMERS FOR AUTOCOMPLETE      //
// ======================================================================//



    }