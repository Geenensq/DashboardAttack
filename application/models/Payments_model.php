<?php
/**
 * Dashboard Attack, command manager
 * payments_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payments_model extends CI_Model
{
// =======================================================================//
    // !                  Declaration of my attributes                       //
    // ======================================================================//
    private $id_method_payment;
    private $name_method;
    public $table = "methods_payments";

// =======================================================================//
    // !                  Constructor of my Class                            //
    // ======================================================================//
    public function __construct()
    {

    }

// =======================================================================//
    // !                     Start methods getters                           //
    // ======================================================================//
    public function getIdMethodPayment()
    {
        return $this->id_method_payment;
    }

    public function getNameMethod()
    {
        return $this->name_method;
    }

// =======================================================================//
    // !                     Start methods setters                           //
    // ======================================================================//
    public function setIdMethodPayment($id_method_payment)
    {
        $this->id_method_payment = $id_method_payment;

        return $this;
    }
    public function setNameMethod($name_method)
    {
        $this->name_method = $name_method;

        return $this;
    }

    // =======================================================================//
    // !                      Method SELECT * payments                       //
    // ======================================================================//

    public function selectAll()
    {
        $arrayPayments = [];
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        foreach ($query->result_object() as $ligne) {
            $payments = new payments_model();
            $payments->setIdMethodPayment($ligne->id_method_payment);
            $payments->setNameMethod($ligne->name_method);
            $arrayPayments[] = $payments;
        }
        return $arrayPayments;
    }

    // =======================================================================//
    // !                 Method INSERT one shipping method                   //
    // ======================================================================//

    public function insertMethodsPayments($model)
    {
        $name_method_payment = $model->getNameMethod();
        $this->db->set('name_method', $name_method_payment)
            ->insert($this->table);
    }

    // =======================================================================//
    // !             Method SELECT * payments method for datatable           //
    // ======================================================================//

    public function loadPaymentsDatatable()
    {
        $this->db->select('`id_method_payment`, `name_method`,  `actif` ');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    // =======================================================================//
    // !            Method for disable and enable an payment method           //
    // ======================================================================//

    public function disableEnableOnePaymentMethod($id)
    {
        $this->db->select('actif');
        $this->db->from($this->table);
        $this->db->where('id_method_payment', $id);
        $query = $this->db->get();
        $result = $query->result_array();

        if ($result[0]['actif'] == 0) {

            $data = array('actif' => 1);
            $this->db->where('id_method_payment', $id);
            $this->db->update($this->table, $data);
        } else {

            $data = array('actif' => 0);
            $this->db->where('id_method_payment', $id);
            $this->db->update($this->table, $data);
        }
    }

    // =======================================================================//
    // !           Method SELECT ALL payments informations FOR MODAL          //
    // ======================================================================//
    public function selectAllPaymentsForModal($id)
    {

        $this->db->select('*')
            ->from($this->table)
            ->where('id_method_payment', $id);

        $query = $this->db->get();

        foreach ($query->result() as $row) {

            $paymentMethod["id_method_payment"] = $row->id_method_payment;
            $paymentMethod["name_method_payment"] = $row->name_method;
            $paymentMethod["actif"] = $row->actif;
        }

        return $paymentMethod;
    }

    // =======================================================================//
    // !                 Method update an method payment by id               //
    // ======================================================================//

    public function updateMethodsPayments($model)
    {

        $id_method_payment = $model->getIdMethodPayment();
        $name_method_payment = $model->getNameMethod();

        $this->db->set('name_method', $name_method_payment);
        $this->db->where('id_method_payment', $id_method_payment);
        $this->db->update($this->table);
    }

}
