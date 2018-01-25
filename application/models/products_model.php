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

    public function getBasePrice()
    {
        return $this->base_price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImgUrl()
    {
        return $this->img_url;
    }

    public function getIdGroupColor()
    {
        return $this->id_group_color;
    }

    public function getIdGroupProduct()
    {
        return $this->id_group_product;
    }

    public function getIdGroupSize()
    {
        return $this->id_group_size;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getDescription()
    {
        return $this->description;
    }



// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setImgUrl($img_url)
    {
        $this->img_url = $img_url;
        return $this;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;
        return $this;
    }

    public function setBasePrice($base_price)
    {
        $this->base_price = $base_price;

        return $this;
    }

    public function setIdGroupColor($id_group_color)
    {
        $this->id_group_color = $id_group_color;

        return $this;
    }

    public function setIdGroupProduct($id_group_product)
    {
        $this->id_group_product = $id_group_product;

        return $this;
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
        $this->load->model('sizes_model', 'modelSizes');
        $this->load->model('colors_model', 'modelColors');

        $name = $model->getName();
        $reference = $model->getReference();
        $description = $model->getDescription();
        $base_price = $model->getBasePrice();
        $id_group_product = $model->getIdGroupProduct();
        $id_color = $model->modelColors->getIdColor();
        $id_size = $model->modelSizes->getIdSize();
        $img_url = $model->getImgUrl();

        $this->db->set('product_name' , $name)
            ->set('reference' , $reference)
            ->set('description' , $description)
            ->set('base_price' , $base_price)
            ->set('img_url' , $img_url)
            ->set('id_color' , $id_color)
            ->set('id_group_product' , $id_group_product)
            ->set('id_size' , $id_size)
            ->insert($this->table);
    }

// =======================================================================//
// !           Method for disable and enable the groups colors           //
// ======================================================================//

    public function disableEnableOneProduct($id)
    {
        $this->db->select('actif');
        $this->db->from($this->table);
        $this->db->where('id_product', $id );
        $query = $this->db->get();
        $result = $query->result_array();

        if($result[0]['actif'] == 0){

            $data = array ('actif' => 1 );
            $this->db->where('id_product' , $id);
            $this->db->update($this->table , $data);
        } else {

            $data = array ('actif' => 0 );
            $this->db->where('id_product' , $id);
            $this->db->update($this->table , $data);
        }
    }


// =======================================================================//
// !                  Method update a products by its id                    //
// ======================================================================//

    public function updateNameProducts($model)
    {
        $data = array ('id_product' =>$model->getIdProduct(),
            'product_name' =>$model->getName(),
            'reference' =>$model->getReference(),
            'description' =>$model->getDescription(),
            'base_price' =>$model->getBasePrice(),
            'img_url' =>$model->getImgUrl(),
            'id_group_product' =>$model->getIdGroupProduct(),
            'id_color' =>$model->getIdGroupColor(),
            'id_size' =>$model->getIdGroupSize()
        );

        $this->db->where('id_product' , $model->getIdProduct());
        $this->db->update($this->table , $data);
    }


// =======================================================================//
// !           Method SELECT *  colors for datatable                     //
// ======================================================================//

    public function loadDataProductsDataTable()
    {
        $this->db->select
        ('id_product, product_name , reference, products.description AS description , base_price , img_url, products.actif AS actif, groups_products.name_group_product AS name_groups_products , colors.color_name AS colors_names , sizes.size_name AS sizes_names');

        $this->db->from($this->table);
        $this->db->join('groups_products', 'products.id_group_product = groups_products.id_group_product');
        $this->db->join('colors', 'products.id_color = colors.id_color');
        $this->db->join('sizes', 'products.id_size = sizes.id_size');

        $query = $this->db->get();
        
        return $query->result_array();
    }



// =======================================================================//
// !           Method SELECT ALL products informations FOR MODAL           //
// ======================================================================//
    public function selectAllProductsForModal($id)
    {
        $this->db->select('id_product, product_name , reference, products.description AS description , base_price , img_url, products.actif AS actif, groups_products.name_group_product AS name_groups_products , products.id_group_product AS id_groups_products , colors.color_name AS colors_names , sizes.size_name AS sizes_names');

        $this->db->from($this->table);
        $this->db->join('groups_products', 'products.id_group_product = groups_products.id_group_product');
        $this->db->join('colors', 'products.id_color = colors.id_color');
        $this->db->join('sizes', 'products.id_size = sizes.id_size');

        $this->db->where('id_product' , $id);
        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            $products["id_product"] =  $row->id_product;
            $products["product_name"] = $row->product_name;
            $products["reference"] = $row->reference;
            $products["description"] = $row->description;
            $products["base_price"] = $row->base_price;
            $products["img_url"] = $row->img_url;
            $products["img_url"] = $row->img_url;
            $products["name_groups_products"] = $row->name_groups_products;
            $products["id_groups_products"] = $row->id_groups_products;
            $products["colors_names"] = $row->colors_names;
            $products["sizes_names"] = $row->sizes_names;
            $products["actif"] = $row->actif;
        }

        return $products;

    }


}



?>
