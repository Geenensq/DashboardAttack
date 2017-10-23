<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class News_model extends CI_Model
    {
        //------------Attributes------------//
        private $autor;
        private $title;
        private $content;
        private $id;
        protected $table = 'news';
        //--------------------------------//
        
        

        //-------- Constructor--------//
        public function __construct()
        {

        }
        //---------------------------//

        // ---------------------------------------- Getters methods----------------------------------//
        public function getAutor()
        {
            return $this->autor;
        }

        public function getTitle()
        {
            return $this->title;
        }

        public function getContent()
        {
            return $this->content;
        }

        public function getId()
        {
            return $this->id;
        }
        //-----------------------------------------------------------------------------------------------//

        //---------------------------------------Setters methods-----------------------------------------//
        public function setId($id)
        {
            return $this->id = $id;
        }

        public function setAutor($autor)
        {
            return $this->autor = $autor;
        }

        public function setTitle($title)
        {
            return $this->title = $title;
        }

        public function setContent($content)
        {
            return $this->content = $content;
        }
        //-----------------------------------------------------------------------------------------------//

        //-----------------------------PERSISTENCE METHOD FOR ADD MY NEWS-------------------------------//
        public function ajouter_News($model)
        {
            $auteur  = $model->getAutor();
            $titre   = $model->getTitle();
            $contenu = $model->getContent();

            return $this->db->set('autor', $auteur)
                            ->set('title', $titre)
                            ->set('content', $contenu)
                            ->set('date_add', 'NOW()', false)
                            ->set('date_modif', 'NOW()', false)
                            ->insert($this->table);
        }
        //-----------------------------------------------------------------------------------------------//

        //-----------------------------PERSISTENCE METHOD FOR DEL MY NEWS-------------------------------//
        public function supprimer_news($model)
        {
            $id = $model->getId();

            return $this->db->where('id', (int)$id)
                            ->delete($this->table);
        }
        //-----------------------------------------------------------------------------------------------//

       
        //----------------------------SELECT ALL MY NEWS FROM MY TABLE NEWS------------------------------//
        public function liste_news()
        {
            $arrayNews = array();

            $query = $this->db->query("SELECT * from news");
                
               foreach ($query->result_object() as $ligne)
                {   
                      $News = new News_model();                      
                      $News->setId($ligne->id);
                      $News->setAutor($ligne->autor);
                      $News->setTitle($ligne->title);
                      $News->setContent($ligne->content);
                      $arrayNews[] = $News;
 
                } 
                
                return $arrayNews;         
        }
        
        //-----------------------------------------------------------------------------------------------//

        //----------------------------SELECT AN NEWS WITH AN ID-----------------------------------------//
        public function getonebyid($id)
        {
                 $query = $this->db->query('SELECT * FROM news WHERE `id` = ' . $id);
                 foreach ($query->result_object() as $ligne)
                 {
                      $myNews = new News_model();                      
                      $myNews->setId($ligne->id);
                      $myNews->setAutor($ligne->autor);
                      $myNews->setTitle($ligne->title);
                      $myNews->setContent($ligne->content);
                 }

                 return $myNews;
         } 
       //-----------------------------------------------------------------------------------------------//  





        // TODO
        // 
        // public function editer_news($id, $titre = null, $contenu = null)
        // {
        //     //  Il n'y a rien à éditer
        //     if ($titre == null AND $contenu == null)
        //     {
        //         return false;
        //     }
        //     //  Ces données seront échappées
        //     if ($titre != null)
        //     {
        //         $this->db->set('titre', $titre);
        //     }

        //     if ($contenu != null)
        //     {
        //         $this->db->set('contenu', $contenu);
        //     }
        //     return $this->db->set('date_modif', 'NOW()', false)->where('id', (int)$id)->update($this->table);
        //     }

      
        

      
        // public function count($where = array())
        // {
        //     return (int)$this->db->where($where)->count_all_results($this->table);
        // }

        
       

      

    }



