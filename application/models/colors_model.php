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
   private $color_name;
   private $color_code;
   private $id_group_color;
   private $actif;

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//

public function getIdColor()
{
    return $this->id_color;
}

public function getColorName()
{
    return $this->color_name;
}

public function getColorCode()
{
    return $this->color_code;
}

public function getIdGroupColor()
{
    return $this->id_group_color;
}

public function getActif()
{
    return $this->actif;
}

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
public function setIdColor($id_color)
{
    $this->id_color = $id_color;

    return $this;
}

public function setColorName($color_name)
{
    $this->color_name = $color_name;

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

public function setActif($actif)
{
    $this->actif = $actif;

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
  $name = $model->getColorName();
  $colorCode = $model->getColorCode();
  $group_color = $model->getIdGroupColor();

  $this->db->set('color_name', $name)
  ->set('color_code', $colorCode)
  ->set('id_group_color' , $group_color)
  ->set('actif' , 1)
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
// !      Method SELECT ALL colors and groups color for product form     //
// ======================================================================//
public function selectAllColorsForProduct()
{
    $query = $this->db->query('SELECT * FROM colors , groups_colors WHERE colors.id_group_color = groups_colors.id_group_color ORDER BY name_group_color');
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


 // =======================================================================//
// !                  Method update a colors by its id                    //
// ======================================================================//
public function updateNameColor($model)
{
    $data = array ('id_color' =>$model->getIdColor(),
     'color_name' =>$model->getColorName(),
     'color_code' =>$model->getColorCode(),
     'id_group_color' =>$model->getIdGroupColor()
 );

    $this->db->where('id_color' , $model->getIdColor());
    $this->db->update($this->table , $data);
}









}



?>
