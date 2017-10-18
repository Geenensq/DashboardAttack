<?php

class News_controller extends CI_Controller
{ 
    //------------------------------------CONSTRUCTOR CONTROLLER--------------------------// 
        function __construct()
        {
            parent::__construct();
            //loading the model news
            $this->load->model('news_model' , 'modelNews');
        }
    //------------------------------------------------------------------------------------//    

    //------------------------------------DEFAULT LOAD METHOD----------------------------//     
        public function index()
        {
           ///Loading my default view
            $this->load->view('/news/news.html');
        }
    //------------------------------------------------------------------------------------//  
  

    //----------------------------------METHOD FOR ADD AN NEWS WITH MY MODEL---------------//
        public function addnews() 
        { 
                // Get _POST for my model
                $this->modelNews->setAutor($this->input->post('autor'));
                $this->modelNews->setTitle($this->input->post('title'));
                $this->modelNews->setContent($this->input->post('content'));
         
                ///Launch method model for add an news 
                $newsModel = $this->modelNews;
                $addnews = $this->modelNews->ajouter_news($newsModel); 

                //Redirection to my default method
                redirect(array('news_controller', 'index')); 
        }            
    //------------------------------------------------------------------------------------//
    

    //--------------------------METHOD FOR DELETE AN NEWS WITH MY MODEL------------------//   
        public function deletenews()
        {
                    // Get _POST for my model
                    $this->modelNews->setId($this->input->post('id'));

                    ///Launch method model delete my news by id 
                    $newsModel = $this->modelNews;
                    $delnews = $this->modelNews->supprimer_news($newsModel);

                    //Redirection to my default method
                     redirect(array('news_controller', 'index'));  
        }
    //------------------------------------------------------------------------------------//     
    
}