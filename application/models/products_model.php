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
    
    private $color;
    private $size;
    private $group_product;

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

    public function getColor()
    {
        return $this->color;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getGroupProduct()
    {
        return $this->group_product;
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

    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }


    public function setGroupProduct($group_product)
    {
        $this->group_product = $group_product;

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

    public function loadDataProducts()
    {
        $this->db->select('id_product, product_name , reference, products.description AS description , base_price , img_url, products.actif AS actif, groups_products.name_group_product AS name_groups_products , colors.color_name AS colors_names , sizes.size_name AS sizes_names');

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
        $this->db->select('id_product, product_name , reference, products.description AS description , base_price , img_url, products.actif AS actif, groups_products.name_group_product AS name_groups_products , products.id_group_product AS id_groups_products , colors.color_name AS colors_names , colors.id_color AS id_color , sizes.size_name AS sizes_names , sizes.id_size AS id_size , sizes.price AS size_price');

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
            $products["id_color"] = $row->id_color;
            $products["sizes_names"] = $row->sizes_names;
            $products["id_size"] = $row->id_size;
            $products["actif"] = $row->actif;
            $products["sizes_price"] = $row->size_price;
        }

        return $products;

    }


// ======================================================================//
// !          Method for select products for autocompletion             //
// ======================================================================//

    public function selectALLAutoComplete($search){
       
        $this->db->select('CONCAT(reference, " " ,product_name, " " ,color_name, " ",size_name) AS text, id_product AS id');
        $this->db->from($this->table);
        $this->db->join('groups_products' , 'products.id_group_product = groups_products.id_group_product');
        $this->db->join('colors' , 'products.id_color = colors.id_color');
        $this->db->join('sizes' , 'products.id_size = sizes.id_size');
        $this->db->like('CONCAT(reference, " " ,product_name, " " ,color_name, " ",size_name)', $search);

        $query = $this->db->get();

        $json = [];

        foreach ($query->result_object() as $row){

            $json[] = ['id'=> $row->id, 'text'=> $row->text ];
        }
        
        return $json;

    }


// =======================================================================//
// !                                                                     //
// ======================================================================//
    public function selectAll()
    {
        $this->load->model('colors_model' , 'modelColors');
        $this->load->model('sizes_model' , 'modelSizes');
        $this->load->model('groups_products_model' , 'modelGroupsProducts');

        $this->db->select('id_product , product_name , reference , products.description AS product_description , base_price , img_url , products.actif AS product_actif ,
            products.id_group_product AS id_group_product  , groups_products.id_group_product AS group_product_id_group_product , groups_products.name_group_product AS name_group_product , groups_products.description AS group_product_description ,
            groups_products.actif AS group_product_actif , colors.id_color AS id_color , colors.color_name AS color_name , colors.color_code AS color_code , colors.actif AS
            color_actif , colors.id_group_color AS id_group_color , sizes.id_size AS id_size , sizes.size_name AS size_name , sizes.price AS price , sizes.actif AS size_actif , 
            sizes.id_group_size AS id_group_size');

        $this->db->from($this->table);
        $this->db->join('groups_products' , 'products.id_group_product = groups_products.id_group_product');
        $this->db->join('colors' , 'products.id_color = colors.id_color');
        $this->db->join('sizes' , 'products.id_size = sizes.id_size');

        $query = $this->db->get();

        $products = array();

        foreach ($query->result_object() as $ligne) {

            $product = new products_model();
            $product->setIdProduct($ligne->id_product);
            $product->setName($ligne->product_name);
            $product->setReference($ligne->reference);
            $product->setDescription($ligne->product_description);
            $product->setBasePrice($ligne->base_price);
            $product->setImgUrl($ligne->img_url);
            $product->setIdGroupProduct($ligne->id_group_product);

            $color = new colors_model();
            $color->setIdColor($ligne->id_color);
            $color->setColorName($ligne->color_name);
            $color->setColorCode($ligne->color_code);
            $color->setActif($ligne->color_actif);

            $size = new sizes_model();
            $size->setIdSize($ligne->id_size);
            $size->setName($ligne->size_name);
            $size->setPrice($ligne->price);
            $size->setActif($ligne->size_actif);
            $size->setIdGroupSize($ligne->id_group_size);

            $group_product = new groups_products_model();
            $group_product->setIdGroupProduct($ligne->group_product_id_group_product);
            $group_product->setName($ligne->name_group_product);
            $group_product->setDescription($ligne->group_product_description);
            $group_product->setActif($ligne->group_product_actif);


            $product->setColor($color);
            $product->setSize($size);
            $product->setGroupProduct($group_product);

            $products[] = $product;

            
            
        }
        
        return $products;


    }




}







?>
