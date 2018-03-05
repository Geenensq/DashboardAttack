<?php
/**
 * Dashboard Attack, command manager
 * Products_sizes_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Products_sizes_model extends CI_Model
{
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    private $id_size;
    private $id_product;
    protected $table = "products_sizes";


// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
    public function getIdSize()
    {
        return $this->id_size;
    }

    public function getIdProduct()
    {
        return $this->id_product;
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
    
    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;
        return $this;
    }
    
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

// =======================================================================//
// !                     Start CRUD methods                              //
// ======================================================================//

// =======================================================================//
// !                Method to insert size to the product                  //
// ======================================================================//
    public function insertProductsSizes($model)
    {
        $id_size = $model->getIdSize();
        $id_product = $model->getIdProduct();

        $this->db->set('id_product', $id_product)
                ->set('id_size', $id_size)
                ->insert($this->table);
    }

// =======================================================================//
// !           Method to check the existence of the product in size       //
// ======================================================================//
    public function selectProductsBySizes($model)
    {
        $id_size = $model->getIdSize();
        $id_product = $model->getIdProduct();
        $response_result;

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_product', $id_product);
        $this->db->where('id_size', $id_size );
        $query = $this->db->get();
        $result = $query->result_array();

        if(count($result) <= 0){

            $response_result = "not exist";
            return  $response_result;
        } else {

            $response_result = "exist";
            return  $response_result;
        }
    }







}