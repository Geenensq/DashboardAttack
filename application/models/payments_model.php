<?php
/**
 * Dashboard Attack, command manager
 * payments_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Payments_model extends CI_Model
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

            foreach ($query->result_object() as $ligne)
            {
                    $payments = new payments_model();
                    $payments->setIdMethodPayment($ligne->id_method_payment);
                    $payments->setNameMethod($ligne->name_method);
                    $arrayPayments[] = $payments;
            }
                    return $arrayPayments;
    }











}

?>