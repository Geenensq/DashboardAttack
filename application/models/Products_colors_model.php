<?php
/**
 * Dashboard Attack, command manager
 * Products_colors_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Products_colors_model extends CI_Model
{
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    private $id_color;
    private $id_product;
    protected $table = "products_colors";


// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
    public function getIdColor()
    {
        return $this->id_color;
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
    public function setIdColor($id_color)
    {
        $this->id_color = $id_color;

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
    public function insertProductsColors($model)
    {
        $id_color = $model->getIdColor();
        $id_product = $model->getIdProduct();

        $this->db->set('id_product', $id_product)
                ->set('id_color', $id_color)
                ->insert($this->table);
    }

// =======================================================================//
// !           Method to check the existence of the product in size       //
// ======================================================================//
    public function selectProductsByColors($model)
    {
        $id_color = $model->getIdColor();
        $id_product = $model->getIdProduct();
        $response_result;

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_product', $id_product );
        $this->db->where('id_color', $id_color);
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
