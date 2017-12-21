<?php
/**
 * Dashboard Attack, command manager
 * colors_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class colors_model extends CI_Model
    {

// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    	private $table = "colors"; 
    	private $id_color;
    	private $name;
    	private $color_code;
    	private $id_group_color;

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//

    public function getIdColor()
    {
        return $this->id_color;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getColorCode()
    {
        return $this->color_code;
    }

    public function getIdGroupColor()
    {
        return $this->id_group_color;
    }

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
    public function setIdColor($id_color)
    {
        $this->id_color = $id_color;

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setColorCode($color_code)
    {
        $this->color_code = $color_code;

        return $this;
    }

    public function setIdGroupColor($id_group_color)
    {
        $this->id_group_color = $id_group_color;

        return $this;
    }
// =======================================================================//
// !                     Start CRUD methods                              //
// ======================================================================//


// =======================================================================//
// !                   Method for insert an colors                       //
// ======================================================================//

	public function insertOneColor($model)
	{
		$name = $model->getName();
		$colorCode = $model->getColorCode();
		$group_color = $model->getIdGroupColor();

		$this->db->set('color_name', $name)
					->set('color_code', $colorCode)
					->set('id_group_color' , $group_color)
					->insert($this->table);
	}

// =======================================================================//
// !           Method SELECT *  colors for datatable                     //
// ======================================================================//

    public function loadDataColorsDataTable()
    {
        $this->db->select('`id_color`, colors.color_name , `color_code`, colors.actif , groups_colors.name_group_color AS name_groups_colors');
        $this->db->from($this->table);
        $this->db->join('groups_colors', 'colors.id_group_color = groups_colors.id_group_color');
        $query = $this->db->get();
        return $query->result_array();
    }



// =======================================================================//
// !               Method for disable and enable colors                  //
// ======================================================================//

    public function disableEnableOneColor($id)
    {
        $this->db->select('actif');
        $this->db->from($this->table);
        $this->db->where('id_color', $id );
        $query = $this->db->get();
        $result = $query->result_array();

        if($result[0]['actif'] == 0){

            $data = array ('actif' => 1 );
            $this->db->where('id_color' , $id);
            $this->db->update($this->table , $data);
        } else {

            $data = array ('actif' => 0 );
            $this->db->where('id_color' , $id);
            $this->db->update($this->table , $data);
        }
    }


// =======================================================================//
// !           Method SELECT ALL colors informations FOR MODAL           //
// ======================================================================//
    public function selectAllColorsForModal($id)
    {
        $this->db->select('id_color, color_name, color_code, colors.id_group_color AS color_id_group_color , colors.actif AS color_actif, groups_colors.name_group_color as name_group_color');
        $this->db->from($this->table);
        $this->db->join('groups_colors', 'colors.id_group_color  = groups_colors.id_group_color');
        $this->db->where('id_color' , $id);
        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            $colors["id_color"] =  $row->id_color;
            $colors["color_name"] = $row->color_name;
            $colors["color_code"] = $row->color_code;
            $colors["id_group_color"] = $row->color_id_group_color;
            $colors["actif"] = $row->color_actif;
            $colors["name_group_color"] = $row->name_group_color;
        }

        return $colors;

    }






}



?>
