<?php
Class Login_controller extends CI_Controller
{
    //--------------Declarations of attributes-------------//
    private $pseudo;
    private $mdp;
    private $id;
    //-----------------------------------------------------//

    //-------------------Constructor-----------------//
    public function __construct()
    {
        parent::__construct();
        $this->pseudo = $this->input->post('pseudo');
        $this->mdp = $this->input->post('mdp');

    }
    //-----------------------------------------------//

    //----------------Default method-----------------//
    public function index()
    {
        $this->load->view('login/index.html');

    }
    //----------------------------------------------//
    
    public function checkLogin()
    {
        //---------------------------------------------------Form Validation-----------------------------------------------------//
        $this->form_validation->set_rules('pseudo', '"Nom d\'utilisateur"', 'required|min_length[2]');
        $this->form_validation->set_rules('mdp', '"Mot de passe"', 'required|min_length[2]');
        //-----------------------------------------------------------------------------------------------------------------------//
        
        
        //---------------------------------------------If the form is valid-----------------------------------------------------//
        if ($this->form_validation->run())
        {
            $sql = 'SELECT * FROM members WHERE `login` = ? AND `password` = ? ';
            $data = array($this->pseudo,$this->mdp);
            $query = $this->db->query($sql, $data);
            
            // Get id of my member and stock in my attribute id of my object//
            $this->id = $this->db->query($sql, $data)->row()->id_member;     
            //////////////////////////////////////////////////////////////////
            $nb_resultat = $query->num_rows();

            if ($nb_resultat >= 1 ) {
                
                //  Le formulaire est valide
                    $this->loginValid();
                   
            } else {
                
                //  Le formulaire est invalide
                   $this->loginInvalid();
            }    
        //-----------------------------------------------------------------------------------------------------------------------//
       
        } else 

        //----------------------------If the forme is'nt valid load the base view and display error------------------------------// 
            {
             $this->load->view('login/index.html');
            }
        //----------------------------------------------------------------------------------------------------------------------//    
    
    }


    private function loginValid()
    {
        $this->session->set_userdata('id_member',  $this->id);
        $this->session->set_userdata('login',  $this->pseudo);
        redirect(array('dashboard_controller', 'index'));  
    }

    private function loginInvalid()
    {
        $this->load->view('login/index.html');
    }


}