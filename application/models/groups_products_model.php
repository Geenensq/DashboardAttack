<?php
/**
 * Dashboard Attack, command manager
 * groups_products_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Groups_products_model extends CI_Model
    {
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
        protected $table = "groups_products";
        private $id_group_product;
        private $name_group_product;
        private $description;
        private $actif;

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//

    public function getIdGroupProduct()
    {
        return $this->id_group_product;
    }

    public function getActif()
    {
        return $this->actif;
    }

    public function getName()
    {
        return $this->name_group_product;
    }

    public function getDescription()
    {
        return $this->description;
    }


// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
    public function setIdGroupProduct($id_group_product)
    {
        $this->id_group_product = $id_group_product;

        return $this;
    }
      
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    public function setName($name_group_product)
    {
        $this->name_group_product = $name_group_product;

        return $this;
    }


// =======================================================================//
// !                Method for insert an group products                  //
// ======================================================================//

    public function insertOneGroupProducts($model)
    {
        $name = $model->getName();
        $description = $model->getDescription();

        $this->db->set('name_group_product', $name)
                 ->set('description' , $description)
                 ->set('actif' , 1)
                 ->insert($this->table);
    }
// =======================================================================//
// !                Method for select all groups products                //
// ======================================================================//

        public function selectAll()
        {
            $arrayGroupsProducts = [];
            $this->db->select('*');
            $this->db->from($this->table);
          
            $this->db->where('actif', 1 );
            $query = $this->db->get();
 
            foreach ($query->result_object() as $ligne)
            {

                    $groupsProducts = new Groups_products_model();
                    $groupsProducts->setIdGroupProduct($ligne->id_group_product);
                    $groupsProducts->setName($ligne->name_group_product);
                    $arrayGroupsProducts[] = $groupsProducts;
            }
                    /// osef de ici wesh
                    return $arrayGroupsProducts;
        }


// =======================================================================//
// !          Method SELECT * groups products for datatable              //
// ======================================================================//

    public function loadDataGroupsProductsDataTable()
    {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }



// =======================================================================//
// !           Method SELECT ALL colors informations FOR MODAL           //
// ======================================================================//
    public function selectAllGroupsProductForModal($id)
    {

        $this->db->select('*')->from('groups_products')->where('id_group_product', $id);
        $query = $this->db->get();
        foreach ($query->result() as $row)
        {
            $groupsProducts["id_group_product"] =  $row->id_group_product;
            $groupsProducts["name_group_product"] = $row->name_group_product;
            $groupsProducts["description"] = $row->description;
            $groupsProducts["actif"] = $row->actif;
        }

        return $groupsProducts;

    }

// =======================================================================//
// !           Method for disable and enable the groups products           //
// ======================================================================//

    public function disableEnableOneGroupProducts($id)
    {
        $this->db->select('actif');
        $this->db->from($this->table);
        $this->db->where('id_group_product', $id );
        $query = $this->db->get();
        $result = $query->result_array();

        if($result[0]['actif'] == 0){

            $data = array ('actif' => 1 );
            $this->db->where('id_group_product' , $id);
            $this->db->update($this->table , $data);
        } else {

            $data = array ('actif' => 0 );
            $this->db->where('id_group_product' , $id);
            $this->db->update($this->table , $data);
        }
    }


// =======================================================================//
// !            Method update a group of products by its id                //
// ======================================================================//

        public function updateNameGroupProducts($model){
            $data = array ('name_group_product' =>$model->getName() ,
                           'description' =>$model->getDescription());

            $this->db->where('id_group_product' , $model->getIdGroupProduct());
            $this->db->update($this->table , $data);
        }



}

?>