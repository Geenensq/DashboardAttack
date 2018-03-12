<?php
/**
 * Dashboard Attack, command manager
 * products_orders_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

Class products_orders_model extends CI_Model
{

// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    private $quantity_product;
    private $custom_price;
    private $id_product;
    private $id_order; 	
    private $id_size;
    private $id_color;
    private $id_meaning;
    
    protected $table = "products_orders";
// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
    public function getQuantityProduct()
    {
        return $this->quantity_product;
    }

    public function getCustomPrice()
    {
        return $this->custom_price;
    }

    public function getIdProduct()
    {
        return $this->id_product;
    }

    public function getIdOrder()
    {
        return $this->id_order;
    }

    public function getIdSize()
    {
        return $this->id_size;
    }

    public function getIdColor()
    {
        return $this->id_color;
    }

    public function getIdMeaning()
    {
        return $this->id_meaning;
    }
    
// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
    public function setQuantityProduct($quantity_product)
    {
        $this->quantity_product = $quantity_product;

        return $this;
    }

    public function setCustomPrice($custom_price)
    {
        $this->custom_price = $custom_price;

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

    public function setIdColor($id_color)
    {
        $this->id_color = $id_color;

        return $this;
    }

    public function setIdSize($id_size)
    {
        $this->id_size = $id_size;
        return $this;
    }

    public function setIdMeaning($id_meaning)
    {
        $this->id_meaning = $id_meaning;
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
        $id_color = $model->getIdColor();
        $id_size = $model->getIdSize();
        $id_meaning = $model->getIdMeaning();

        $this->db->set('id_product', $id_product)
        ->set('quantity_product', $qte_product)
        ->set('id_order' , $id_order)
        ->set('id_color' , $id_color)
        ->set('id_size' , $id_size)
        ->set('id_meaning' , $id_meaning)
        ->insert($this->table);
    }


// =======================================================================//
// !                  DELETING A PRODUCT FROM AN ORDER                    //
// ======================================================================//

    public function deleteProductOrder($model)
    {
        $id_product = $model->getIdProduct();
        $id_order = $model->getIdOrder();
        $id_size = $model->getIdSize();
        $id_color = $model->getIdColor();
        $id_meaning = $model->getIdMeaning();

        $this->db->where('id_product', $id_product);
        $this->db->where('id_order', $id_order);
        $this->db->where('id_size', $id_size);
        $this->db->where('id_color', $id_color);
        $this->db->where('id_meaning', $id_meaning);
        $this->db->delete($this->table);
    }
// =======================================================================//
// !         DELETE ALL PRODUCTS FROM ORDER FOR DELETE ORDER             //
// ======================================================================//
    public function deleteProcuctsOrder($model)
    {
        $id_order = $model->getIdOrder();
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
        $id_size = $model->getIdSize();
        $id_color = $model->getIdColor();
        $id_meaning = $model->getIdMeaning();

        $this->db->set('quantity_product', $new_quantity);
        $this->db->where('id_order', $id_order);
        $this->db->where('id_product', $id_product);
        $this->db->where('id_size', $id_size);
        $this->db->where('id_color', $id_color);
        $this->db->where('id_meaning', $id_meaning);
        $this->db->update($this->table);

    }

// =======================================================================//
// !                  SELECT * product from an orders                    //
// ======================================================================//
    public function selectAllProductsOrders($id)
    {
        $id_order = $id;
        $this->db->select('products.id_product , products.product_name , products.reference , products.description , products.base_price , products.img_url , products_orders.quantity_product , colors.color_name , colors.id_color , meanings.id_meaning, meanings.meaning_name, sizes.size_name , sizes.id_size , sizes.price AS size_price');
        $this->db->from($this->table);
        $this->db->join('products', 'products.id_product = products_orders.id_product');
        $this->db->join('orders', 'orders.id_order = products_orders.id_order');
        $this->db->join('colors', 'colors.id_color = products_orders.id_color');
        $this->db->join('sizes', 'sizes.id_size = products_orders.id_size');
        $this->db->join('meanings' ,'meanings.id_meaning = products_orders.id_meaning');
        $this->db->where('orders.id_order', $id_order);
        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();

    }


// =======================================================================//
// !           Method SELECT ALL products informations FOR table          //
// ======================================================================//
    public function selectInfosProductsOrders($model)
    {
        $id_order = $model->getIdOrder();
        $id_size = $model->getIdSize();
        $id_product = $model->getIdProduct();
        $id_color = $model->getIdColor();
        $id_meaning = $model->getIdMeaning();

        $this->db->select('products.id_product , products.product_name , products.reference , products.description , products.base_price , products.img_url , products_orders.quantity_product , colors.color_name , colors.id_color , meanings.id_meaning, meanings.meaning_name ,sizes.size_name , sizes.id_size , sizes.price AS size_price');
        
        $this->db->from($this->table);
        $this->db->join('products' , 'products.id_product = products_orders.id_product');
        $this->db->join('sizes' , 'sizes.id_size  = products_orders.id_size');
        $this->db->join('colors' , 'colors.id_color  = products_orders.id_color');
        $this->db->join('meanings' ,'meanings.id_meaning = products_orders.id_meaning');
        $this->db->join('orders' ,'orders.id_order = products_orders.id_order');

        $this->db->where('products_orders.id_product' , $id_product);
        $this->db->where('products_orders.id_size' , $id_size);
        $this->db->where('products_orders.id_color' , $id_color);
        $this->db->where('products_orders.id_order' , $id_order);
        $this->db->where('products_orders.id_meaning' , $id_meaning);
        $query = $this->db->get();
        

        foreach ($query->result() as $row)
        {
            $products["id_product"] =  $row->id_product;
            $products["product_name"] = $row->product_name;
            $products["reference"] = $row->reference;
            $products["description"] = $row->description;
            $products["base_price"] = $row->base_price;
            $products["img_url"] = $row->img_url;
            $products["quantity_product"] = $row->quantity_product;
            $products["color_name"] = $row->color_name;
            $products["id_color"] = $row->id_color;
            $products["id_meaning"] = $row->id_meaning;
            $products["meaning_name"] = $row->meaning_name;
            $products["size_name"] = $row->size_name;
            $products["id_size"] = $row->id_size;
            $products["size_price"] = $row->size_price;
        }

        return $products;
    }



// =======================================================================//
// !       Select * for check if product is already in a command          //
// ======================================================================//
    public function selectCheckProductInOrder($model)
    {
        $id_product = $model->getIdProduct();
        $id_order = $model->getIdOrder();
        $id_size = $model->getIdSize();
        $id_color = $model->getIdColor();
        $id_meaning = $model->getIdMeaning();

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_product', $id_product);
        $this->db->where('id_color', $id_color);
        $this->db->where('id_size', $id_size);
        $this->db->where('id_meaning',$id_meaning);
        $this->db->where('id_order', $id_order );
        $query = $this->db->get();
        $result = $query->result_array();
        
        if(count($result) <= 0){
            /*returns false if the product is'not in command*/
            return false;

        } else {
            /*returns true if the product is not associated with the command*/
            return true;
        }

    }



}
?>
