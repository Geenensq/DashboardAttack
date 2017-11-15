<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Groups_members_model extends CI_Model
    {   
        private $id_group_member;
        private $name;
        protected $table = "groups_members";

        //-------- Constructor--------//
        public function __construct()
        {
            
        }
        //---------------------------//

        // ---------------------------------------- Getters methods----------------------------------//
        public function getIdGroupMember()
        {
            return $this->id_group_member;
        }

        public function getName()
        {
            return $this->name;
        }
       
        // -------------------------------------------------------------------------------------------//

        // ---------------------------------------- Setters methods----------------------------------//
        public function setIdGroupMember($id_group_member)
        {
            return $this->id_group_member = $id_group_member;
        }
        public function setName($name)
        {
            return $this->name = $name;
        }
        // -------------------------------------------------------------------------------------------//

 

        
    }

?>