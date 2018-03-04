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
    private $id_group_product;
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

    public function getIdGroupProduct()
    {
        return $this->id_group_product;
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

    public function setIdGroupProduct($id_group_product)
    {
        $this->id_group_product = $id_group_product;

        return $this;
    }


// =======================================================================//
// !                    Method for insert an products                    //
// ======================================================================//

    public function insertOneProduct($model)
    {

        $name = $model->getName();
        $reference = $model->getReference();
        $description = $model->getDescription();
        $base_price = $model->getBasePrice();
        $id_group_product = $model->getIdGroupProduct();
        $img_url = $model->getImgUrl();

        $this->db->set('product_name' , $name)
        ->set('reference' , $reference)
        ->set('description' , $description)
        ->set('base_price' , $base_price)
        ->set('img_url' , $img_url)
        ->set('id_group_product' , $id_group_product)
        ->set('actif' , 1)
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
// !                     Select an products by its id                    //
// ======================================================================//
    public function selectProductsById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
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
            $products["actif"] = $row->actif;
            $products["id_group_product"] = $row->id_group_product;
            $products["id_color"] = $row->id_color;
            $products["id_size"] = $row->id_size;
        }

        return $products;

    }



// =======================================================================//
// !                  Method update a products by its id                  //
// ======================================================================//

    public function updateNameProduct($model)
    {
        $data = array ('id_product' =>$model->getIdProduct(),
            'product_name' =>$model->getName(),
            'reference' =>$model->getReference(),
            'description' =>$model->getDescription(),
            'base_price' =>$model->getBasePrice(),
            'img_url' =>$model->getImgUrl(),
            'id_group_product' =>$model->getIdGroupProduct()
        );

        $this->db->where('id_product' , $model->getIdProduct());
        $this->db->update($this->table , $data);
    }


// =======================================================================//
// !           Method SELECT * products for datatable                     //
// ======================================================================//

    public function loadDatasProducts()
    {
        $this->db->select('id_product, product_name , reference, products.description AS description , base_price , img_url, products.actif AS actif, groups_products.name_group_product AS name_groups_products');
        $this->db->from($this->table);
        $this->db->join('groups_products', 'products.id_group_product = groups_products.id_group_product');
        $query = $this->db->get();
    
        return $query->result_array();
    }

// =======================================================================//
// !           Method SELECT ALL products informations FOR MODAL           //
// ======================================================================//
    public function selectAllProductsForModal($id)
    {
        $this->db->select('id_product, product_name , reference, products.description AS description , base_price , img_url, products.actif AS actif, groups_products.name_group_product AS name_groups_products , products.id_group_product AS id_groups_products');

        $this->db->from($this->table);
        $this->db->join('groups_products', 'products.id_group_product = groups_products.id_group_product');
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
            $products["actif"] = $row->actif;
        }

        return $products;

    }


// ======================================================================//
// !          Method for select products for autocompletion             //
// ======================================================================//

    public function selectAllProductsAutoComplete($search){

        $this->db->select('CONCAT(reference, " " ,product_name) AS text, id_product AS id');
        $this->db->from($this->table);
        $this->db->join('groups_products' , 'products.id_group_product = groups_products.id_group_product');
        $this->db->like('CONCAT(reference, " " ,product_name)', $search);

        $query = $this->db->get();
        $json = [];

        foreach ($query->result_object() as $row){
            $json[] = ['id'=> $row->id, 'text'=> $row->text ];
        }
        
        return $json;

    }


}



?>
