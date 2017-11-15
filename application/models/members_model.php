<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class Members_model extends CI_Model
    {   
        private $id;
        private $login;
        private $password;
        private $email;
        private $actif;
        private $id_group_member;
        private $group_member; 
        protected $table = "members";

        //-------- Constructor--------//
        public function __construct()
        {
            $this->load->model('Groups_members_model' , 'GroupsMembersModel');
            $this->group_member = new groups_members_model(); 
        }
        //---------------------------//

        // ---------------------------------------- Getters methods----------------------------------//
        public function getId()
        {
            return $this->id;
        }

        public function getLogin()
        {
            return $this->login;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function getEmail()
        {
            return $this->email;
        }

        public function getActif()
        {
            return $this->actif;
        }

        public function GetIdGroupMember()
        {
            return $this->id_group_member;
        }

        public function getGroupMember()
        {
            return $this->group_member;
        }
        // -------------------------------------------------------------------------------------------//

        // ---------------------------------------- Setters methods----------------------------------//

        public function setId($id)
        {
            return $this->id = $id;
        }
        public function setLogin($login)
        {
            return $this->login = $login;
        }

        public function setPassword($password)
        {
            return $this->password = $password;
        }

        public function setEmail($email)
        {
            return $this->email = $email;
        }

        public function setActif($actif)
        {
            return $this->actif = $actif;
        }

        public function SetIdGroupMember($id_group_member)
        {
            return $this->id_group_member = $id_group_member;
        }

        public function SetGroupMember($group_member)
        {
            return $this->group_member = $group_member;
        }
        // -------------------------------------------------------------------------------------------//

        // ----------------------------------------CHECK INFO USERS----------------------------------//
        public function CheckInfoUser($model){
            $data = array ('login' => $model->getLogin(),'password' => $model->getPassword());

            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where($data);
            $query = $this->db->get();

                if(count($query->result_array())  >= 1)
                {
                    $result = $query->result_object()[0];
                    $myMembers = new Members_model();
                    $myMembers->setId($result->id_member);
                    $myMembers->setLogin($result->login);
                    $myMembers->setPassword($result->password);
                    $myMembers->setEmail($result->email);
                    $myMembers->setActif($result->actif);
                    $myMembers->SetIdGroupMember($result->id_group_member);
                    return $myMembers;
            
                } else {
                    
                    return false;
                }
                       
        }
        // -------------------------------------------------------------------------------------------//

        // ------------------------------SELECT ONE USER BY ID---------------------------------------//
        public function getOne($id)
        {
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('id_member', $id );
            $query = $this->db->get();
            foreach ($query->result_object() as $ligne)
            {
                $myMembers = new Members_model();
                $myMembers->setId($ligne->id_member);
                $myMembers->setLogin($ligne->login);
                $myMembers->setPassword($ligne->password);
                $myMembers->setActif($ligne->actif);
                $myMembers->setEmail($ligne->email);
                //$myMembers->SetIdGroupMember($ligne->id_group_member);
                $myMembers->group_member = $myMembers->group_member->getOneGroupMember($ligne->id_group_member);
                $arrayMyMembers[] = $myMembers;
            }
                return $arrayMyMembers;
        }
        // -------------------------------------------------------------------------------------------//
       
        // ------------------------------SELECT ALL USERS--------------------------------------------//
        public function getAll()
        {
            $query = $this->db->get($this->table);
            foreach ($query->result_object() as $ligne)
            {
                    $members = new Members_model();
                    $members->setId($ligne->id_member);
                    $members->setLogin($ligne->login);
                    $members->setPassword($ligne->password);
                    $members->setActif($ligne->actif);
                    $members->setEmail($ligne->email);
                    $members->SetIdGroupMember($ligne->id_group_member);
                    $arrayMembers[] = $members;
            }
                    return $arrayMembers;
        }
        // -------------------------------------------------------------------------------------------//
        
        // ---------------------------------INSERT AN MEMBERS----------------------------------------//
        public function insertMember($model)
        {
            //----------------------------------------------//
            $login  = $model->getLogin();
            $password = $model->getPassword();
            $actif = $model->getActif();
            $email = $model->getEmail();
            $id_group_member = $model->GetIdGroupMember();
            //----------------------------------------------//
            
            //-----------Check if a user already has this username or email address ------------//
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('login', $login );
            $this->db->or_where('email', $email);
            $query = $this->db->get();
            //----------------------------------------------------------------------------------//
            if (empty($query->result_array())){
                   return $this->db->set('login', $login)
                            ->set('password', $password)
                            ->set('actif', $actif)
                            ->set('email', $email)
                            ->set('id_group_member', $id_group_member)
                            ->insert($this->table);
            }   
        }
        // -------------------------------------------------------------------------------------------//
        
        // ---------------------------------UPDATE AN MEMBERS----------------------------------------//
        public function updateMember($model)
        {

           $data = array (
                    'login' => $model->getLogin(),
                    'password' => $model->getPassword(),
                    'actif' => $model->getActif(),
                    'email' => $model->getEmail(),
                    'id_group_member' =>$model->GetIdGroupMember()    
          );

                    $this->db->where('id_member' ,$model->getId());
                    $this->db->update($this->table , $data);
        }
        // -------------------------------------------------------------------------------------------//
        
        // ---------------------------UPDATE MEMBERS ON PROFIL PAGE----------------------------------//
        public function updateProfilMember($model)
        {
           $data = array ('password' => $model->getPassword(), 'email' => $model->getEmail());
                    $this->db->where('id_member' ,$model->getId());
                    $this->db->update($this->table , $data);
        }
        // -------------------------------------------------------------------------------------------//
        
        // ---------------------------------DISABLE AN MEMBERS----------------------------------------//
        public function disableMember($model)
        {
                $data = array ('actif' => 0 );
                $this->db->where('id_member' ,$model->getId());
                $this->db->update($this->table , $data);   
        }
        // -------------------------------------------------------------------------------------------//

         public function selectGroupMember($model)
         {
            $id = $model->getId();
            $this->db->select('name');
            $this->db->from('groups_members');
            $this->db->where('id_group_member', $id );
            $query = $this->db->get();

         }
    }

?>