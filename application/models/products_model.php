<?php
/**
 * Dashboard Attack, command manager
 * products_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class products_model extends CI_Model
    {

// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
        protected $table = "products";
        private $id_product;
        private $name;
        private $reference;
        private $description;
        private $base_price;
        private $id_group_color;
        private $id_group_product;
        private $id_group_size;
        private $img_url;

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//

    public function getIdProduct()
    {
        return $this->id_product;
    }

    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getImgUrl()
    {
        return $this->img_url;
    }

    public function setImgUrl($img_url)
    {
        $this->img_url = $img_url;

        return $this;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//

    public function getBasePrice()
    {
        return $this->base_price;
    }

    public function setBasePrice($base_price)
    {
        $this->base_price = $base_price;

        return $this;
    }

    public function getIdGroupColor()
    {
        return $this->id_group_color;
    }

    public function setIdGroupColor($id_group_color)
    {
        $this->id_group_color = $id_group_color;

        return $this;
    }

    public function getIdGroupProduct()
    {
        return $this->id_group_product;
    }

    public function setIdGroupProduct($id_group_product)
    {
        $this->id_group_product = $id_group_product;

        return $this;
    }

    public function getIdGroupSize()
    {
        return $this->id_group_size;
    }

    public function setIdGroupSize($id_group_size)
    {
        $this->id_group_size = $id_group_size;

        return $this;
    }
// =======================================================================//
// !                    Method for insert an products                    //
// ======================================================================//

    public function insertOneProducts($model)
    {
        $name = $model->getName();
        $reference = $model->getReference();
        $description = $model->getDescription();
        $base_price = $model->getBasePrice();
        $id_group_product = $model->getIdGroupProduct();
        $id_group_color = $model->getIdGroupColor();
        $id_group_size = $model->getIdGroupSize();
        $img_url = $model->getImgUrl();

        $this->db->set('product_name' , $name)
            ->set('reference' , $reference)
            ->set('description' , $description)
            ->set('base_price' , $base_price)
            ->set('img_url' , $img_url)
            ->set('id_group_color' , $id_group_color)
            ->set('id_group_product' , $id_group_product)
            ->set('id_group_size' , $id_group_size)
            ->insert($this->table);
    }


}



?>
