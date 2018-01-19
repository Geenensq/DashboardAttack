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
	private $name_group_colors;
    private $colors_list;

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
    public function getColorsList($id)
    {
        /// LOAD DU MODELE COLORS

        /// Select * from colors where id_group_color = $id 
        
        /// Boucle pour remplir un tableau d'objets couleurs pour toutes les couleurs de la requettes

/*        foreach ($query->result_object() as $ligne)
        {
            $groupsColors = new Groups_colors_model();
            $groupsColors->setIdGroupColor($ligne->id_group_color);
            $groupsColors->setNameGroupColors($ligne->name_group_color);
            $arrayGroupsColors[] = $groupsColors;
        }*/
            
        
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getIdGroupColor()
    {
        return $this->id_group_color;
    }

    public function getNameGroupColors()
    {
        return $this->name_group_colors;
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

    public function setNameGroupColors($name_group_colors)
    {
        $this->name_group_colors = $name_group_colors;
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
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        foreach ($query->result_object() as $ligne)
        {
            $groupsColors = new Groups_colors_model();
            $groupsColors->setIdGroupColor($ligne->id_group_color);
            $groupsColors->setNameGroupColors($ligne->name_group_color);
            $arrayGroupsColors[] = $groupsColors;
        }

        return $arrayGroupsColors;
    }

// =======================================================================//
// !              Method for insert an group of colors                   //
// ======================================================================//

    public function insertOneGroupColors($model)
    {
        $name = $model->getNameGroupColors();
        $this->db->set('name_group_color', $name)
        ->insert($this->table);
    }

// =======================================================================//
// !           Method SELECT * groups colors for datatable               //
// ======================================================================//

    public function loadDataGroupsColorsDataTable()
    {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }


// =======================================================================//
// !           Method for disable and enable the groups colors           //
// ======================================================================//

    public function disableEnableOneGroupColor($id)
    {
        $this->db->select('actif');
        $this->db->from($this->table);
        $this->db->where('id_group_color', $id );
        $query = $this->db->get();
        $result = $query->result_array();

        if($result[0]['actif'] == 0){

            $data = array ('actif' => 1 );
            $this->db->where('id_group_color' , $id);
            $this->db->update($this->table , $data);
        } else {

            $data = array ('actif' => 0 );
            $this->db->where('id_group_color' , $id);
            $this->db->update($this->table , $data);
        }
    }



// =======================================================================//
// !           Method SELECT ALL colors informations FOR MODAL           //
// ======================================================================//
    public function selectAllGroupsColorForModal($id)
    {

        $this->db->select('*')->from('groups_colors')->where('id_group_color', $id);
        $query = $this->db->get();
        foreach ($query->result() as $row)
        {
            $groupsColors["id_group_color"] =  $row->id_group_color;
            $groupsColors["name_group_color"] = $row->name_group_color;
            $groupsColors["actif"] = $row->actif;
        }

        return $groupsColors;

    }


// =======================================================================//
// !            Method update a group of colors by its id                //
// ======================================================================//

        public function updateNameGroupColors($model){
            $data = array ('name_group_color' =>$model->getNameGroupColors());
            $this->db->where('id_group_color' , $model->getIdGroupColor());
            $this->db->update($this->table , $data);
        }




}

?>