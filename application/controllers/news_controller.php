<?php
Class News_controller extends CI_Controller
{ 

        //------------------------------------CONSTRUCTOR CONTROLLER--------------------------// 
        function __construct()
        {
            parent::__construct();
            
            //loading the model news
            $this->load->model('news_model' , 'modelNews');
        }
        //------------------------------------------------------------------------------------//    

        //------------------------------------index method---------------------------------------//     
        public function index()
        {
            $listeNews = $this->modelNews->liste_news();
            $this->load->view('/news/news.html', array('listeNews' =>$listeNews), false);  
        }
        //------------------------------------------------------------------------------------//  
  
        //----------------------------------method to add news with my model-----------------//
        public function addNews() 
        { 
                //setting rules with the form validation library
                $this->form_validation->set_rules('autor', 'autor of the news', 'encode_php_tags|trim|required|max_length[20]');
                $this->form_validation->set_rules('title', 'title of the news', 'encode_php_tags|trim|required|max_length[70]');
                $this->form_validation->set_rules('content', 'content of the news', 'encode_php_tags|trim|required|max_length[500]');   

                 if ($this->form_validation->run() == FALSE)
                {
                            //Redirect to the default method if the form is not filled correctly
                            redirect(array('news_controller', 'index')); 
                }
                else
                {
                            //Else creating my object with my setter and POST
                            $this->modelNews->setAutor($this->input->post('autor'));
                            $this->modelNews->setTitle($this->input->post('title'));
                            $this->modelNews->setContent($this->input->post('content'));
                     
                            ///Launch method model for add an news 
                            $newsModel = $this->modelNews;
                            $addNews = $this->modelNews->ajouter_News($newsModel); 

                            //Redirection to my default method
                            redirect(array('news_controller', 'index')); 
                            }
        }            
        //------------------------------------------------------------------------------------//
    
        //--------------------------method to delete a news based on its id with my model------------------//   
        public function deleteNews()
        {   
                if ($this->input->post('id')){

                    // Get _POST for my model
                    $this->modelNews->setId($this->input->post('id'));

                    ///Launch method model delete my news by id 
                    $newsModel = $this->modelNews;
                    $delnews = $this->modelNews->supprimer_news($newsModel);

                    //Redirection to my default method
                     redirect(array('news_controller', 'index'));  

                }  elseif (isset($_GET['id'])) {

                    $this->modelNews->setId($_GET['id']) ;

                    ///Launch method model delete my news by id 
                    $newsModel = $this->modelNews;
                    $delnews = $this->modelNews->supprimer_news($newsModel);

                    //Redirection to my default method
                     redirect(array('news_controller', 'index'));  
                }           
        }
        //------------------------------------------------------------------------------------//  

        public function testJson()
        {

        $news = $this->modelNews->getonebyid($this->input->get('id'));
        echo json_encode(array( 'id' => $news->getId(), 'Autor'  => $news->getAutor(), 'Content'  => $news->getContent(), 'Title'  => $news->getTitle()   ));

             //TO DO WORK
            // return $this->output
           //      ->set_content_type('application/json')
          //      ->set_output(json_encode(array('key' => 'value')));
        }       
}