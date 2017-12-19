<?php
/**
 * Dashboard Attack, command manager
 * groups_colors_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */


if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class groups_colors_model extends CI_Model
    {

// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
	private $table = "groups_colors"; 
	private $id_group_color;
	private $name;

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//

    public function getTable()
    {
        return $this->table;
    }

    public function getIdGroupColor()
    {
        return $this->id_group_color;
    }

    public function getName()
    {
        return $this->name;
    }

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function setIdGroupColor($id_group_color)
    {
        $this->id_group_color = $id_group_color;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    



// =======================================================================//
// !                     Start CRUD methods                              //
// ======================================================================//


// =======================================================================//
// !                 Method SELECT * groups colors                       //
// ======================================================================//

    public function selectAll()
    {
        $arrayGroupsCustomers = [];
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        foreach ($query->result_object() as $ligne)
        {
            $groupsColors = new Groups_colors_model();
            $groupsColors->setIdGroupColor($ligne->id_group_color);
            $groupsColors->setName($ligne->name);
            $arrayGroupsColors[] = $groupsColors;
        }
        return $arrayGroupsColors;
    }





}

?>