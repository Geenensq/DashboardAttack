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

		$this->db->set('name', $name)
					->set('color_code', $colorCode)
					->set('id_group_color' , $group_color)
					->insert($this->table);
	}

// =======================================================================//
// !           Method SELECT *  colors for datatable                     //
// ======================================================================//

    public function loadDataColorsDataTable()
    {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }







}



?>
