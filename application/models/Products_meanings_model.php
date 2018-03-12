<?php
/**
 * Dashboard Attack, command manager
 * Products_meanings_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Products_meanings_model extends CI_Model
{
    private $id_meaning;
    private $id_product;
    protected $table = "products_meanings";

    // =======================================================================//
    // !                     Start methods getters                           //
    // ======================================================================//

    public function getIdMeaning()
    {
        return $this->id_meaning;
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

    public function setIdMeaning($id_meaning)
    {
        $this->id_meaning = $id_meaning;
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
    // !                Method to insert meaning to the product                //
    // ======================================================================//
    public function insertProductsMeanings($model)
    {
        $id_product = $model->getIdProduct();
        $id_meaning = $model->getIdMeaning();

        $this->db->set('id_product', $id_product)
            ->set('id_meaning', $id_meaning)
            ->insert($this->table);
    }

    // =======================================================================//
    // !           Method to check the existence of the product in meaning    //
    // ======================================================================//
    public function selectProductsByMeanings($model)
    {
        $id_meaning = $model->getIdMeaning();
        $id_product = $model->getIdProduct();

        $response_result;

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_product', $id_product);
        $this->db->where('id_meaning', $id_meaning);
        $query = $this->db->get();
        $result = $query->result_array();

        if (count($result) <= 0) {

            $response_result = "not exist";
            return $response_result;
        } else {

            $response_result = "exist";
            return $response_result;
        }
    }

}
