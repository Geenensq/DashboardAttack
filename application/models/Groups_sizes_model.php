<?php
/**
 * Dashboard Attack, command manager
 * Groups_sizes_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Groups_sizes_model extends CI_Model
    {
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
        private $id_group_size;
        private $name_group_size;
        private $actif;
        private $table = "groups_sizes";

        public $sizes_list;
// =======================================================================//
// !                   Start methods collections                         //
// ======================================================================//

    public function getSizesList()
    {
        /// chargement du modele et on selectionne toute les couleur du groupe passé en params
        $this->load->model('sizes_model', 'modelSizes');
        $this->db->select('*');
        $this->db->from('sizes');;
        $this->db->where('id_group_size', $this->id_group_size);
        $query = $this->db->get();
        //On boucle sur le retour MYSQL
        $sizesCollection = array();
        
        foreach ($query->result_object() as $ligne)
        {
            $sizesModel = new sizes_model();
            $sizesModel->setIdSize($ligne->id_size);
            $sizesModel->setName($ligne->size_name);
            $sizesModel->setPrice($ligne->price);
            $sizesModel->setIdGroupSize($ligne->id_group_size);
            $sizesCollection[] = $sizesModel;
        }

        $this->sizes_list = $sizesCollection; 

    }

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//

    public function getIdGroupSize()
    {
        return $this->id_group_size;
    }
    
    public function getNameGroupSize()
    {
        return $this->name_group_size;
    }

    public function getActif()
    {
        return $this->actif;
    }

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
 

    public function setIdGroupSize($id_group_size)
    {
        $this->id_group_size = $id_group_size;
        return $this;
    }

    public function setNameGroupSize($name_group_size)
    {
        $this->name_group_size = $name_group_size;

        return $this;
    }

    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }


   

// =======================================================================//
// !                 Method SELECT * groups sizes                       //
// ======================================================================//

    public function selectAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('actif', 1 );
        
        $query = $this->db->get();
        $arrayGroupsSizes = array();

        foreach ($query->result_object() as $ligne)
        {
            $groupsSizes = new Groups_sizes_model();
            $groupsSizes->setIdGroupSize($ligne->id_group_size);
            $groupsSizes->setNameGroupSize($ligne->name_group_size);
            $arrayGroupsSizes[] = $groupsSizes;
        }

        foreach ($arrayGroupsSizes as $key => $groupsSizes) {
           $arrayGroupsSizes[$key]->getSizesList();  
        }

        return $arrayGroupsSizes;
    }

// =======================================================================//
// !               Method  for insert one groups sizes                    //
// ======================================================================//

    public function insertOneGroupSizes($model)
    {
        $name_group_size = $model->getNameGroupSize();

        $this->db->set('name_group_size', $name_group_size)
                 ->set('actif', "1")
                 ->insert($this->table);
    }


// =======================================================================//
// !           Method SELECT * groups sizes for datatable               //
// ======================================================================//

    public function loadDataGroupsSizesDataTable()
    {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }


// =======================================================================//
// !           Method for disable and enable the groups sizes           //
// ======================================================================//

    public function disableEnableOneGroupSize($id)
    {
        $this->db->select('actif');
        $this->db->from($this->table);
        $this->db->where('id_group_size', $id );
        $query = $this->db->get();
        $result = $query->result_array();

        if($result[0]['actif'] == 0){

            $data = array ('actif' => 1 );
            $this->db->where('id_group_size' , $id);
            $this->db->update($this->table , $data);
        } else {

            $data = array ('actif' => 0 );
            $this->db->where('id_group_size' , $id);
            $this->db->update($this->table , $data);
        }
    }



// =======================================================================//
// !           Method SELECT ALL sizes informations FOR MODAL           //
// ======================================================================//
    public function selectAllGroupsSizeForModal($id)
    {

        $this->db->select('*')->from('groups_sizes')->where('id_group_size', $id);
        $query = $this->db->get();
        foreach ($query->result() as $row)
        {
            $groupsSizes["id_group_size"] =  $row->id_group_size;
            $groupsSizes["name_group_size"] = $row->name_group_size;
            $groupsSizes["actif"] = $row->actif;
        }

        return $groupsSizes;

    }




// =======================================================================//
// !            Method update a group of sizes by its id                //
// ======================================================================//

        public function updateNameGroupSizes($model){
            $data = array ('name_group_size' =>$model->getNameGroupSize());
            $this->db->where('id_group_size' , $model->getIdGroupSize());
            $this->db->update($this->table , $data);
        }



}

?>