<?php
Class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Loading model
        $this->load->model('news_model' , 'newsManager');
    }
    
    public function accueil()
    {
        $resultat = $this->newsManager->ajouter_news('Arthur',
                             'Un super titre',
                             'Un super contenu !');
         var_dump($resultat);
      
    }
}