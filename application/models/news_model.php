<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class News_model extends CI_Model
    {
        private $autor;
        private $title;
        private $content;
        private $id;

        // Variable for change my entity
        protected $table = 'news';

        public function __construct()
        {
        }

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
        public function ajouter_news($model)
        {
            $auteur = $model->getAutor();
            $titre = $model->getTitle();
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

        
        // public function liste_news($nb = 10, $debut = 0)
        // {
        //     return $this->db->select('*')->from($this->table)->limit($nb, $debut)->order_by('id', 'desc')->get()->result();
                
        // }

        // public function getonebyid($id)
        // {
        //         $query = $this->db->query('SELECT * FROM news WHERE `id` = ' . $id);
        //         foreach ($query->result_array() as $row)
        //         {
        //             echo $row['id'];
        //             echo $row['auteur'];
        //             echo $row['contenu'];
        //         }
        // } 

    }



