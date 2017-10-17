<?php

class News_controller extends CI_Controller
{  

    function __construct()
    {
        parent::__construct();
        $this->load->model('news_model' , 'newsManager');
        // $this->input->post('autor');
        // $this->input->post('title');
        // $this->input->post('content');
        // $this->input->post('id');   
    }


    public function index()
    {
        //--------------------------------Call base view---------------------------//
        //--Here code for sessions------------------------------------------------//
        
        $this->newsManager->getonebyid(12);
        //----Load view----------------------------------------------------------//
        $this->load->view('/news/news.html');
        //----------------------------------------------------------------------//
    }


    public function addnews()
    {

        //$this->input->post('autor');
        //$this->input->post('title');
        //$this->input->post('content');
        //$this->input->post('id');   
      

       // --------------------------------------- Add news instructions -----------------------------------------------------------------------//
        $this->form_validation->set_rules('autor', '"Nom de l\'auteur"', 'trim|required|min_length[1]|max_length[10]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('title', '"titre de la news"', 'trim|required|min_length[1]|max_length[30]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('content', '"contenu de la news"', 'trim|required|min_length[1]|max_length[255]|alpha_dash|encode_php_tags');

            if ($this->form_validation->run())
            {
                $addnews = $this->newsManager->ajouter_news($this->autor , $this->title , $this->content);
                $this->load->view('/news/news.html');
            }
        //--------------------------------------------------------------------------------------------------------------------------------------//   
    }

    public function deletenews()
    {
        //--------------------------------------Delete news instructions------------------------------------------------------------------------//
                $delnews = $this->newsManager->supprimer_news($this->input->post('id'));
                $this->load->view('/news/news.html');
        //--------------------------------------------------------------------------------------------------------------------------------------//     
    }
    
}