<?php
/**
 * Dashboard Attack, command manager
 * product_order_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class product_order_model extends CI_Model
    {

// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    private $quantity_product;
    private $id_product;
    private $id_order; 	
    protected $table = "product_order";
// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
    public function getQuantityProduct()
    {
        return $this->quantity_product;
    }

    public function getIdProduct()
    {
        return $this->id_product;
    }

    public function getIdOrder()
    {
        return $this->id_order;
    }
    
// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
    public function setQuantityProduct($quantity_product)
    {
        $this->quantity_product = $quantity_product;

        return $this;
    }

    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;

        return $this;
    }

    public function setIdOrder($id_order)
    {
        $this->id_order = $id_order;

        return $this;
    }

// =======================================================================//
// !                     Start CRUD methods                              //
// ======================================================================//

// =======================================================================//
// !                     INSERT ONE PRODUCT ORDER                        //
// ======================================================================//
    public function insertOneProductOrder($model)
    {
        $id_product = $model->getIdProduct();
        $qte_product = $model->getQuantityProduct();
        $id_order = $model->getIdOrder();
        $this->db->set('id_product', $id_product)
                 ->set('quantity_product', $qte_product)
                 ->set('id_order' ,$id_order )
                 ->insert($this->table);
    }


// =======================================================================//
// !                  DELETING A PRODUCT FROM AN ORDER                    //
// ======================================================================//

    public function deleteProductOrder($model)
    {
        $id_product = $model->getIdProduct();
        $id_order = $model->getIdOrder();
        $this->db->where('id_product', $id_product);
        $this->db->where('id_order', $id_order);
        $this->db->delete($this->table);
    }
// =======================================================================//
// !                  DELETING A PRODUCT FROM AN ORDER                    //
// ======================================================================//

    public function updateQuantityProduct($model)
    {
        $id_order = $model->getIdOrder();
        $id_product = $model->getIdProduct();
        $new_quantity = $model->getQuantityProduct();

        $this->db->set('quantity_product', $new_quantity);
        $this->db->set('id_product', $id_product);
        $this->db->where('id_order', $id_order);
        $this->db->update($this->table);

    }

// =======================================================================//
// !                  SELECT * product from an orders                    //
// ======================================================================//
    public function selectAllProductsOrders($id)
    {
        $id_order = $id;
        $this->db->select('product_order.quantity_product , products.id_product , products.product_name , products.reference,products.description,products.base_price,products.img_url');

        $this->db->from($this->table);
        $this->db->join('products', 'products.id_product = product_order.id_product');
        $this->db->join('orders', 'orders.id_order = product_order.id_order');
        $this->db->where('orders.id_order', $id_order);
        $query = $this->db->get();

        
        foreach ($query->result() as $row) {

            $product_order["quantity_product"] = $row->quantity_product;
            $product_order["id_product"] = $row->id_product;
            $product_order["product_name"] = $row->product_name;
            $product_order["reference"] = $row->reference;
            $product_order["description"] = $row->description;
            $product_order["base_price"] = $row->base_price;
            $product_order["img_url"] = $row->img_url;
          
        }
        return $product_order;

    }

// =======================================================================//
// !       Select * for check if product is already in a command          //
// ======================================================================//
    public function selectCheckProductInOrder($model)
    {
        $id_product = $model->getIdProduct();
        $id_order = $model->getIdOrder();

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_product', $id_product );
        $this->db->where('id_order', $id_order );
        $query = $this->db->get();
        $result = $query->result_array();
        
        if(count($result) === 0){
            /*returns false if the product is in command*/
            return false;

        } else {
            /*returns true if the product is not associated with the command*/
            return true;
        }

    }



}
?>
