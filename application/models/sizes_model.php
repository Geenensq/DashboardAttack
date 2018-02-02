<?php
/**
 * Dashboard Attack, command manager
 * sizes_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Sizes_model extends CI_Model
    {
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
        private $id_size;
        private $name;
        private $price;
        private $actif;
        private $id_group_size; 
        protected $table = "sizes";

// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//
        public function __construct()
        {

        }

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//

    public function getIdSize()
    {
        return $this->id_size;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getIdGroupSize()
    {
        return $this->id_group_size;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getActif()
    {
        return $this->actif;
    }

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
    public function setIdSize($id_size)
    {
        $this->id_size = $id_size;

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    public function setIdGroupSize($id_group_size)
    {
        $this->id_group_size = $id_group_size;

        return $this;
    }

    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }



// =======================================================================//
// !                    Method for insert an size                        //
// ======================================================================//

    public function insertOneSize($model)
    {
        $name = $model->getName();
        $price = $model->getPrice();
        $group_size = $model->getIdGroupSize();

        $this->db->set('size_name', $name)
                    ->set('price', $price)
                    ->set('id_group_size' , $group_size)
                    ->insert($this->table);
    }


// =======================================================================//
// !           Method SELECT *  sizes for datatable                     //
// ======================================================================//

    public function loadDataSizesDataTable()
    {
        $this->db->select('`id_size`, sizes.size_name , `price`, sizes.actif , groups_sizes.name_group_size AS name_groups_sizes');
        $this->db->from($this->table);
        $this->db->join('groups_sizes', 'sizes.id_group_size = groups_sizes.id_group_size');
        $query = $this->db->get();
        return $query->result_array();
    }


// =======================================================================//
// !                Method for disable and enable size                   //
// ======================================================================//

    public function disableEnableOneSize($id)
    {
        $this->db->select('actif');
        $this->db->from($this->table);
        $this->db->where('id_size', $id );
        $query = $this->db->get();
        $result = $query->result_array();

        if($result[0]['actif'] == 0){

            $data = array ('actif' => 1 );
            $this->db->where('id_size' , $id);
            $this->db->update($this->table , $data);
        } else {

            $data = array ('actif' => 0 );
            $this->db->where('id_size' , $id);
            $this->db->update($this->table , $data);
        }
    }



 // =======================================================================//
// !           Method SELECT ALL sizes informations FOR MODAL           //
// ======================================================================//
    public function selectAllSizesForModal($id)
    {
        $this->db->select('id_size, size_name, price, sizes.id_group_size AS size_id_group_size , sizes.actif AS size_actif, groups_sizes.name_group_size as name_group_size');
        $this->db->from($this->table);
        $this->db->join('groups_sizes', 'sizes.id_group_size  = groups_sizes.id_group_size');
        $this->db->where('id_size' , $id);
        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            $sizes["id_size"] =  $row->id_size;
            $sizes["size_name"] = $row->size_name;
            $sizes["price"] = $row->price;
            $sizes["id_group_size"] = $row->size_id_group_size;
            $sizes["actif"] = $row->size_actif;
            $sizes["name_group_size"] = $row->name_group_size;
        }

        return $sizes;

    }


// =======================================================================//
// !                  Method update a size by its id                    //
// ======================================================================//

    public function updateNameSizes($model){
        $data = array ('id_size' =>$model->getIdSize(),
                        'size_name' =>$model->getName(),
                        'price' =>$model->getPrice(),
                        'id_group_size' =>$model->getIdGroupSize()
                        );

        $this->db->where('id_size' , $model->getIdSize());
        $this->db->update($this->table , $data);
        
        }


}

?>