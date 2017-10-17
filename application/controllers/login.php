<?php
Class Login extends CI_Controller
{

    private $pseudo;
    private $mdp;

    public function __construct()
    {
        parent::__construct();
        $this->pseudo = $this->input->post('pseudo');
        $this->mdp = $this->input->post('mdp');
    }

    public function index()
    {
        $this->form_validation->set_rules('pseudo', '"Nom d\'utilisateur"', 'trim|required|min_length[5]|max_length[52]|alpha_dash|encode_php_tags');
        $this->form_validation->set_rules('mdp', '"Mot de passe"', 'trim|required|min_length[5]|max_length[52]|alpha_dash|encode_php_tags');
        if ($this->form_validation->run())
        {
            $sql = 'SELECT * FROM membre WHERE `pseudo` = ? AND `password` = ? ';
            $data = array(
                $this->pseudo,
                $this->mdp
            );

            $query = $this->db->query($sql, $data);
            $nb_resultat = $query->num_rows();
            if ($nb_resultat <= 1)
            {
                //  Le formulaire est valide
                $this->load->view('login/connexion_reussie.html');
            }
        }
        else
        {
            //  Le formulaire est invalide ou vide
            $this->load->view('login/index.html');
        }
    }
}