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

    protected $table = "orders";


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

// =======================================================================//
// !                     Method for get status stats                     //
// ======================================================================//
    public function OrdersStatusStats()
    {
        $this->db->select('COUNT(*) AS how_much , orders.id_state , states.name_state');
        $this->db->from($this->table);
        $this->db->join('states', 'orders.id_state = states.id_state');
        $this->db->group_by("id_state");
        $this->db->order_by("id_state");
        $query = $this->db->get();

        return $query->result_array();
        
    } 

// =======================================================================//
// !             Method for get price of shipping by order               //
// ======================================================================//
    public function selectPriceShippingOrders($model)
    {
        $id_order = $model->getIdOrder();
        $this->db->select('id_order , orders.id_method_shipping , methods_shippings.name_method_shipping , methods_shippings.price_method_shipping');
        $this->db->from($this->table);
        $this->db->join('methods_shippings', 'orders.id_method_shipping = methods_shippings.id_method_shipping');
        $this->db->where('id_order', $id_order);
        $query = $this->db->get();
        
        foreach ($query->result() as $row)
        {
            $result["id_method_shipping"] =  $row->id_method_shipping;
            $result["id_order"] =  $row->id_order;
            $result["name_method_shipping"] =  $row->name_method_shipping;
            $result["price_method_shipping"] =  $row->price_method_shipping;
        }
        
        return $result;
    }  

// =======================================================================//
// !                method to get the last 6 orders                     //
// ======================================================================//
    public function lastOrders()
    {
        $this->db->select('orders.id_order , states.name_state , customers.firstname , customers.lastname');
        $this->db->from($this->table);
        $this->db->join('states', 'orders.id_state = states.id_state');
        $this->db->join('customers', 'orders.id_customer = customers.id_customer');
        $this->db->order_by("id_order");
        $query = $this->db->get();

        return $query->result_array();
        
    }  
// =======================================================================//
// !         Method for delete an order after delete product order       //
// ======================================================================//
    public function deleteOrders($model)
    {
        $id_order = $model->getIdOrder();
        $this->db->where('id_order', $id_order);
        $this->db->delete($this->table);
        
    }

// =======================================================================//
// !           Method to calculate the earnings on every month           //
// ======================================================================//
    public function selectEarningsByMonths()
    {

        $this->db->select('MONTH(date_order) AS month, YEAR(date_order) AS years, COUNT(*) AS how_much_order , SUM(price_order) AS total_order');
        $this->db->from($this->table);
        $this->db->group_by("month");
        $this->db->group_by("years");
        $this->db->order_by("years");
        $this->db->order_by("month");
        $query = $this->db->get();
        return $query->result_array();
        
    } 

// =======================================================================//
// !                     Method for insert one order                     //
// ======================================================================//
    public function insertOneOrder($model){
        $id_customer = $model->getIdCustomer();
        $date_order = $model->getDateOrder();
        $status_order = $model->getStatusOrder();
        $comment_order = $model->getCommentOrder();
        $price_order = $model->getPriceOrder();
        $method_payment = $model->getIdMethodPayment();
        $method_shipping = $model->getIdMethodShipping();

        $this->db->set('id_customer', $id_customer)
        ->set('date_order', $date_order)
        ->set('id_state' , $status_order)
        ->set('comment_order' , $comment_order)
        ->set('price_order' , $price_order)
        ->set('id_method_payment' , $method_payment)
        ->set('id_method_shipping' , $method_shipping)
        ->insert($this->table);
        return $this->db->insert_id();

    }
// =======================================================================//
// !         Method for select all information from table orders         //
// ======================================================================//
    public function selectAllOrders($id)
    {
        $id_order = $id;
        $this->db->select('id_order, date_order , comment_order, price_order , customers.firstname AS firstname , customers.lastname AS lastname , customers.id_customer AS id_customer ,
        customers.mobil_phone_number , customers.phone_number , customers.address , customers.zip_code , customers.city,
        methods_payments.name_method AS method_payment , methods_payments.id_method_payment AS id_method_payment ,
        methods_shippings.name_method_shipping AS method_shipping , methods_shippings.id_method_shipping AS id_method_shipping , methods_shippings.price_method_shipping,
        states.name_state AS name_state , states.id_state AS id_state');
        $this->db->from($this->table);
        $this->db->join('customers', 'orders.id_customer = customers.id_customer');
        $this->db->join('methods_payments', 'orders.id_method_payment = methods_payments.id_method_payment');
        $this->db->join('methods_shippings', 'orders.id_method_shipping = methods_shippings.id_method_shipping');
        $this->db->join('states', 'orders.id_state = states.id_state');
        $this->db->where('id_order', $id_order);
        $query = $this->db->get();
        
        foreach ($query->result() as $row) {
            $order["id_order"] = $row->id_order;
            $order["date_order"] = $row->date_order;
            $order["comment_order"] = $row->comment_order;
            $order["price_order"] = $row->price_order;
            $order["firstname"] = $row->firstname;
            $order["lastname"] = $row->lastname;
            $order["id_customer"] = $row->id_customer;
            $order["mobil_phone_number"] = $row->mobil_phone_number;
            $order["phone_number"] = $row->phone_number;
            $order["address"] = $row->address;
            $order["zip_code"] = $row->zip_code;
            $order["city"] = $row->city;
            $order["method_payment"] = $row->method_payment;
            $order["id_method_payment"] = $row->id_method_payment;
            $order["method_shipping"] = $row->method_shipping;
            $order["id_method_shipping"] = $row->id_method_shipping;
            $order["price_method_shipping"] = $row->price_method_shipping;
            $order["name_state"] = $row->name_state;
            $order["id_state"] = $row->id_state;
        }
        return $order;

    }

// =======================================================================//
// !                    Method update an order with id                    //
// ======================================================================//
    public function updateOneOrder($model){
     $id_order = $model->getIdOrder();
     $id_customer = $model->getIdCustomer();
     $date_order = $model->getDateOrder();
     $price_order = $model->getPriceOrder();
     $comment_order = $model->getCommentOrder();
     $method_payment = $model->getIdMethodPayment();
     $method_shipping = $model->getIdMethodShipping();
     $state_order = $model->getStatusOrder();

     $this->db->set('date_order', $date_order);
     $this->db->set('comment_order', $comment_order);
     $this->db->set('price_order', $price_order);
     $this->db->set('id_customer', $id_customer);
     $this->db->set('id_method_payment', $method_payment);
     $this->db->set('id_method_shipping', $method_shipping);
     $this->db->set('id_state', $state_order);
     $this->db->where('id_order' , $id_order);
     $this->db->update($this->table);
 }

// =======================================================================//
// !               Method for update the price of the order              //
// ======================================================================//
 public function updatePriceOrder($model)
 {
    $id_order = $model->getIdOrder();
    $price_order = $model->getPriceOrder();
    $this->db->set('price_order', $price_order);
    $this->db->where('id_order', $id_order);
    $this->db->update($this->table); 
}
// =======================================================================//
// !    Method to retrieve order information and send it to datatables    //
// ======================================================================//
public function loadDataOrdersDataTable()
{
    $this->db->select('id_order, date_order , comment_order, price_order , customers.firstname AS firstname , customers.lastname AS lastname , methods_payments.name_method AS method_payment , methods_shippings.name_method_shipping AS method_shipping , states.name_state AS name_state ');
    $this->db->from($this->table);
    $this->db->join('customers', 'orders.id_customer = customers.id_customer');
    $this->db->join('methods_payments', 'orders.id_method_payment = methods_payments.id_method_payment');
    $this->db->join('methods_shippings', 'orders.id_method_shipping = methods_shippings.id_method_shipping');
    $this->db->join('states', 'orders.id_state = states.id_state');
    $query = $this->db->get();
    $sql = $this->db->last_query();
    return $query->result_array();
}


// =======================================================================//
// !                  Method to update the delivery method                //
// ======================================================================//
public function updateShippingOrder($model)
{
    $id_order = $model->getIdOrder();
    $method_shipping = $model->getIdMethodShipping();
    $this->db->set('id_method_shipping', $method_shipping);
    $this->db->where('id_order', $id_order);
    $this->db->update($this->table); 

}







}