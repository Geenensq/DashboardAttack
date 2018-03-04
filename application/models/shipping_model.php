<?php
/**
 * Dashboard Attack, command manager
 * shipping_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Shipping_model extends CI_Model
{
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    private $id_method_shipping;
    private $name_method_shipping;
    protected $table = "methods_shippings";

// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//
    public function __construct()
    {

    }

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
    public function getIdMethodShipping()
    {
        return $this->id_method_shipping;
    }
    public function getNameMethodShipping()
    {
        return $this->name_method_shipping;
    }
    public function getTable()
    {
        return $this->table;
    }
    
// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//

    public function setIdMethodShipping($id_method_shipping)
    {
        $this->id_method_shipping = $id_method_shipping;

        return $this;
    }

    public function setNameMethodShipping($name_method_shipping)
    {
        $this->name_method_shipping = $name_method_shipping;

        return $this;
    }

    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }


// =======================================================================//
// !                      Method SELECT * shipping                       //
// ======================================================================//

    public function selectAll()
    {
        $arrayShippings = [];
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        foreach ($query->result_object() as $ligne)
        {
            $shipping = new Shipping_model();
            $shipping->setIdMethodShipping($ligne->id_method_shipping);
            $shipping->setNameMethodShipping($ligne->name_method_shipping);
            $arrayShippings[] = $shipping;
        }
        return $arrayShippings;
    }


 // =======================================================================//
// !                      Method SELECT * shipping by id                  //
// ======================================================================//   
    public function selectShippingsInfos($model)
    {
        $id_method_shipping = $model->getIdMethodShipping();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_method_shipping' , $id_method_shipping);
        $query = $this->db->get();
        
        foreach ($query->result() as $row)
        {
            $result["id_method_shipping"] =  $row->id_method_shipping;
            $result["name_method_shipping"] =  $row->name_method_shipping;
            $result["price_method_shipping"] =  $row->price_method_shipping;
        }
        
        return $result;
    }



}

?>