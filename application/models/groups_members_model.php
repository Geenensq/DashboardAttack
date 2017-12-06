<?php
/**
 * Dashboard Attack, command manager
 * groups_members_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Groups_members_model extends CI_Model
    {
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
        private $id_group_member;
        private $name;
        protected $table = "groups_members";

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
        public function getIdGroupMember()
        {
            return $this->id_group_member;
        }

        public function getName()
        {
            return $this->name;
        }

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
        public function setIdGroupMember($id_group_member)
        {
            return $this->id_group_member = $id_group_member;
        }
        
        public function setName($name)
        {
            return $this->name = $name;
        }
// =======================================================================//
// !                     Start CRUD methods                              //
// ======================================================================//



// =======================================================================//
// !                Method SELECT one group members                      //
// ======================================================================//
        public function getOneGroupMember($id_group_member)
        {
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('id_group_member', $id_group_member);
            $query = $this->db->get();
            foreach ($query->result_object() as $ligne)
            {
                $myMembers = new Groups_members_model();
                $myMembers->setIdGroupMember($ligne->id_group_member);
                $myMembers->setName($ligne->name);
                
            }
                return $myMembers;
        }
    }

?>