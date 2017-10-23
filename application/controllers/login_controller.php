<?php
Class Login_controller extends CI_Controller
{
    //--------------Declarations of attributes-------------//
    private $pseudo;
    private $mdp;
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
         //-----------load view-----------//
        $this->load->view('login/index.html');
        //------------------------------//
    }
    //----------------------------------------------//
    
    public function checkLogin()
    {
        //--------------------------------------------------Form Validation-----------------------------------------------------------------------------//
        $this->form_validation->set_rules('pseudo', '"Nom d\'utilisateur"', 'required|min_length[2]');
        $this->form_validation->set_rules('mdp', '"Mot de passe"', 'required|min_length[2]');
        //---------------------------------------------------------------------------------------------------------------------------------------------//
        
        //-------------------------------------------------If the form is valid-----------------------------------------------------------------------//
        if ($this->form_validation->run())
        {
            $sql = 'SELECT * FROM membre WHERE `pseudo` = ? AND `password` = ? ';

            $data = array($this->pseudo,$this->mdp);
            
            $query = $this->db->query($sql, $data);

            $nb_resultat = $query->num_rows();
            
            if ($nb_resultat >= 1 ) {
                //  Le formulaire est valide
                    $this->loginValid($nb_resultat['id_membre']);
            } else {
                //  Le formulaire est invalide
                   redirect(array('login_controller', 'loginInvalid'));
            }    
        //-----------------------------------------------------------------------------------------------------------------------------------------//
       
        } else 

        //-----------------------------------------If the forme is'nt valid load the base view and display error----------------------------------// 
            {
             $this->load->view('login/index.html');

            }
        //-----------------------------------------------------------------------------------------------------------------------------------------//    
    
    }


    public function loginValid()
    {
        $this->session->set_userdata('username', $this->pseudo);

    }

    public function loginInvalid()
    {
        $this->load->view('login/index.html');
    }

}