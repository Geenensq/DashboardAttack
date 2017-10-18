<?php

class News_controller extends CI_Controller
{  

        function __construct()
        {
            parent::__construct();
            $this->load->model('news_model' , 'newsManager');
        }

        public function index()
        {
            //--------------------------------Call base view---------------------------//  
            $this->load->view('/news/news.html');
            //----------------------------------------------------------------------//
        }

        //--------------------------------------------------------------------------------------------------------------------------------------//
        public function addnews() 
        { 

                // Get _POST for my model  
                $auteur = $this->input->post('autor'); 
                $titre = $this->input->post('title'); 
                $contenu = $this->input->post('content'); 

                ///Launch
                $addnews = $this->newsManager->ajouter_news($auteur , $titre , $contenu); 
                redirect(array('news_controller', 'index')); 
             
        }            
        //--------------------------------------------------------------------------------------------------------------------------------------//   
    

        public function deletenews()
        {
            //--------------------------------------Delete news instructions------------------------------------------------------------------------//
                    $delnews = $this->newsManager->supprimer_news($this->input->post('id'));
                    $this->load->view('/news/news.html');
            //--------------------------------------------------------------------------------------------------------------------------------------//     
        }
    
}