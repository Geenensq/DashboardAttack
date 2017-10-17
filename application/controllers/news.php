<?php
/**
 * Controller add news
 * Il me permet d'ajouter une news en utilisantmon model news model
 */
class News extends CI_Controller
{  
    private $autor;
    private $title;
    private $content;
    private $id;

    function __construct()
    {
        parent::__construct();
        $this->autor = $this->input->post('autor');
        $this->title = $this->input->post('title');
        $this->content = $this->input->post('content');
        $this->id = $this->input->post('id');
        $this->load->model('news_model' , 'newsManager');
    }

    /**
     * [index description]
     * Validation du formulaire via la librairie form valisation
     * Ajout de la news en base via notre modele
     * @return [view] [Retourne une vue html]
     */
    public function index()
    {
        //--------------------------------Call base view---------------------------//
        //--Here code for sessions------------------------------------------------//
        
        //----Load view----------------------------------------------------------//
        $this->load->view('/news/news.html');
        //----------------------------------------------------------------------//
    }


    public function addnews()
    {
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
               $delnews = $this->newsManager->supprimer_news($this->id);
                $this->load->view('/news/news.html');
        //--------------------------------------------------------------------------------------------------------------------------------------//     
    }
    
}