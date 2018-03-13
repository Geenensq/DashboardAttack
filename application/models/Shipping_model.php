<?php
/**
 * Dashboard Attack, command manager
 * shipping_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Shipping_model extends CI_Model
{
    // =======================================================================//
    // !                  Declaration of my attributes                       //
    // ======================================================================//
    private $id_method_shipping;
    private $name_method_shipping;
    private $price_method_shipping;
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

    public function getPriceMethodShipping()
    {
        return $this->price_method_shipping;
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

    public function setPriceMethodShipping($price_method_shipping)
    {
        $this->price_method_shipping = $price_method_shipping;

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

        foreach ($query->result_object() as $ligne) {
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
        $this->db->where('id_method_shipping', $id_method_shipping);
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $result["id_method_shipping"] = $row->id_method_shipping;
            $result["name_method_shipping"] = $row->name_method_shipping;
            $result["price_method_shipping"] = $row->price_method_shipping;
        }

        return $result;
    }

    // =======================================================================//
    // !                 Method INSERT one shipping method                   //
    // ======================================================================//

    public function insertMethodShipping($model)
    {
        $name_method_shipping = $model->getNameMethodShipping();
        $price_method_shipping = $model->getPriceMethodShipping();

        $this->db->set('name_method_shipping', $name_method_shipping)
            ->set('price_method_shipping', $price_method_shipping)
            ->insert($this->table);

    }

    // =======================================================================//
    // !             Method SELECT * shipping method for datatable           //
    // ======================================================================//

    public function loadShippingsDatatable()
    {
        $this->db->select('`id_method_shipping`, `name_method_shipping`, `price_method_shipping` , `actif` ');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    // =======================================================================//
    // !                Method for disable and enable an members              //
    // ======================================================================//

    public function disableEnableOneShippingMethod($id)
    {
        $this->db->select('actif');
        $this->db->from($this->table);
        $this->db->where('id_method_shipping', $id);
        $query = $this->db->get();
        $result = $query->result_array();

        if ($result[0]['actif'] == 0) {

            $data = array('actif' => 1);
            $this->db->where('id_method_shipping', $id);
            $this->db->update($this->table, $data);
        } else {

            $data = array('actif' => 0);
            $this->db->where('id_method_shipping', $id);
            $this->db->update($this->table, $data);
        }
    }

    // =======================================================================//
    // !           Method SELECT ALL shipping informations FOR MODAL          //
    // ======================================================================//
    public function selectAllShippingsForModal($id)
    {

        $this->db->select('*')
                 ->from($this->table)
                 ->where('id_method_shipping', $id);

        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $shippingMethod["id_method_shipping"] = $row->id_method_shipping;
            $shippingMethod["name_method_shipping"] = $row->name_method_shipping;
            $shippingMethod["price_method_shipping"] = $row->price_method_shipping;
            $shippingMethod["actif"] = $row->actif;
        }

        return $shippingMethod;

    }


// =======================================================================//
// !                 Method update an method shipping by id               //
// ======================================================================//

public function updateMethodsShippings($model){
    
    $id_method_shipping = $model->getIdMethodShipping();
    $price_method_shipping = $model->getPriceMethodShipping();
    $name_method_shipping = $model->getNameMethodShipping();

    $this->db->set('name_method_shipping', $name_method_shipping);
    $this->db->set('price_method_shipping', $price_method_shipping);
    $this->db->where('id_method_shipping' , $id_method_shipping);
    $this->db->update($this->table);
}

}
