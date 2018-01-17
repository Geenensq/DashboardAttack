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



}

?>