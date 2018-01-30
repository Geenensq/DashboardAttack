<?php
/**
 * Dashboard Attack, command manager
 * orders_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Orders_model extends CI_Model
    {
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    private $id_order;
    private $date_order;
    private $status_order;
    private $comment_order;
    private $price_order;
    private $id_customer;
    private $id_method_payment;
    private $id_method_shipping;


// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
   
    public function getIdOrder()
    {
        return $this->id_order;
    }

    public function getDateOrder()
    {
        return $this->date_order;
    }

    public function getStatusOrder()
    {
        return $this->status_order;
    }

    public function getCommentOrder()
    {
        return $this->comment_order;
    }

    public function getPriceOrder()
    {
        return $this->price_order;
    }

    public function getIdCustomer()
    {
        return $this->id_customer;
    }

    public function getIdMethodPayment()
    {
        return $this->id_method_payment;
    }

    public function getIdMethodShipping()
    {
        return $this->id_method_shipping;
    }
    

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
     
    public function setIdOrder($id_order)
    {
        $this->id_order = $id_order;

        return $this;
    }
    
    public function setDateOrder($date_order)
    {
        $this->date_order = $date_order;

        return $this;
    }
   
    public function setStatusOrder($status_order)
    {
        $this->status_order = $status_order;

        return $this;
    }
    
    public function setCommentOrder($comment_order)
    {
        $this->comment_order = $comment_order;

        return $this;
    }
    
    public function setPriceOrder($price_order)
    {
        $this->price_order = $price_order;

        return $this;
    }
    
    public function setIdCustomer($id_customer)
    {
        $this->id_customer = $id_customer;

        return $this;
    }
   
    public function setIdMethodPayment($id_method_payment)
    {
        $this->id_method_payment = $id_method_payment;

        return $this;
    }
    
    public function setIdMethodShipping($id_method_shipping)
    {
        $this->id_method_shipping = $id_method_shipping;

        return $this;
    }


// =======================================================================//
// !                     Start CRUD methods                              //
// ======================================================================//




}