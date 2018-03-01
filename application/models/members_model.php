<?php
/**
 * Dashboard Attack, command manager
 * members_model.php
 * members_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Members_model extends CI_Model
{
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    private $id;
    private $login;
    private $password;
    private $email;
    private $actif;
    private $id_group_member;
    private $group_member; 
    protected $table = "members";

// =======================================================================//
// !                  Constructor of my Class                            //
// ======================================================================//
    public function __construct()
    {
        $this->load->model('Groups_members_model' , 'GroupsMembersModel');
        $this->group_member = new groups_members_model(); 
    }

// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
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

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
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
// =======================================================================//
// !                     Start CRUD methods                              //
// ======================================================================//



// =======================================================================================================//
// !     Method SELECT * members and verify that the user exists and that the password matches           //
// ======================================================================================================//
    public function CheckInfoUser($model)
    {
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
// ==================================================================================//
// !     Method SELECT * and verify that the user id matches the password           //
// ===================================================== ===========================//
    
    public function checkPasswordById($model)
    {
        $data = array ('id_member' => $model->getId(),'password' => $model->getPassword());   
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($data);
        $query = $this->db->get();
        
        if(count($query->result_array())  >= 1)
        {
            return true;
        } else { 
            return false;
        }
    }


// ==================================================================================//
// !                        Method SELECT ONE user by his id                        //
// =================================================================================//
    public function getOne($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_member', $id );
        $query = $this->db->get();

        $result = $query->result_object()[0];

        $myMembers = new Members_model();
        $myMembers->setId($result->id_member);
        $myMembers->setLogin($result->login);
        $myMembers->setPassword($result->password);
        $myMembers->setActif($result->actif);
        $myMembers->setEmail($result->email);
        $myMembers->group_member = $myMembers->group_member->getOneGroupMember($result->id_group_member);
        return $myMembers;
    }
// ==================================================================================//
// !                        Method SELECT ONE * members                             //
// =================================================================================//
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

// ==================================================================================//
// !                        Method for INSERT an members                            //
// =================================================================================//
    public function insertMember($model)
    {
        $login  = $model->getLogin();
        $password = $model->getPassword();
        $actif = $model->getActif();
        $email = $model->getEmail();
        $id_group_member = $model->GetIdGroupMember();
        
            //-----------Check if a user already has this username or email address ------------//
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('login', $login );
        $this->db->or_where('email', $email);
        $query = $this->db->get();
        if (empty($query->result_array())){
         return $this->db->set('login', $login)
         ->set('password', $password)
         ->set('actif', $actif)
         ->set('email', $email)
         ->set('id_group_member', $id_group_member)
         ->insert($this->table);
     }   
 }

// ==================================================================================//
// !                        Method for UPDATE an members                            //
// =================================================================================//
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


// ==================================================================================//
// !                Method for UPDATE an members in management                       //
// =================================================================================//
public function updateMemberModal($model)
{
    $data = array (
        'login' => $model->getLogin(),
        'actif' => $model->getActif(),
        'email' => $model->getEmail(),
        'id_group_member' =>$model->GetIdGroupMember()    
    );

    $this->db->where('id_member' ,$model->getId());
    $this->db->update($this->table , $data);
}


// ==================================================================================//
// !                        Method for UPDATE email members                         //
// =================================================================================//
public function updateEmailMember($model)
{
 $data = array ('email' => $model->getEmail());
 $this->db->where('id_member' ,$model->getId());
 $this->db->update($this->table , $data);
}
// ==================================================================================//
// !                        Method for UPDATE password members                      //
// =================================================================================//

public function updatePasswordMember($model)
{
 $data = array ('password' => $model->getPassword());
 $this->db->where('id_member' ,$model->getId());
 $this->db->update($this->table , $data);
}
// ==================================================================================//
// !      Method to set the active field to 0 and therefore disabled the member     //
// =================================================================================//

public function disableMember($model)
{
    $data = array ('actif' => 0 );
    $this->db->where('id_member' ,$model->getId());
    $this->db->update($this->table , $data);   
}



// =======================================================================//
// !                Method for disable and enable an members              //
// ======================================================================//

public function disableEnableOneMember($id)
{
    $this->db->select('actif');
    $this->db->from($this->table);
    $this->db->where('id_member', $id );
    $query = $this->db->get();
    $result = $query->result_array();

    if($result[0]['actif'] == 0){

        $data = array ('actif' => 1 );
        $this->db->where('id_member' , $id);
        $this->db->update($this->table , $data);
    } else {

        $data = array ('actif' => 0 );
        $this->db->where('id_member' , $id);
        $this->db->update($this->table , $data);
    }
}


// ==================================================================================//
// !                Method to select a group of members with its id                 //
// =================================================================================//
public function selectGroupMember($model)
{
    $id = $model->getId();
    $this->db->select('name');
    $this->db->from('groups_members');
    $this->db->where('id_group_member', $id );
    $query = $this->db->get();

}


// =======================================================================//
// !       Method SELECT * members and groups members for datatable       //
// ======================================================================//

public function loadMembersDatatable()
{
    $this->db->select('`id_member`, `login`, `password`, members.actif AS actif , `email`, members.id_group_member , groups_members.name');
    $this->db->from($this->table);
    $this->db->join('groups_members', 'members.id_group_member = groups_members.id_group_member');
    $query = $this->db->get();
    return $query->result_array();
}


 // =======================================================================//
// !           Method SELECT ALL members informations FOR MODAL           //
// ======================================================================//
public function selectAllMembersForModal($id)
{
    $this->db->select('`id_member`, `login`, `password`, members.actif AS actif , `email`, members.id_group_member AS id_group_member , groups_members.name AS name');
    $this->db->from($this->table);
    $this->db->join('groups_members', 'members.id_group_member  = groups_members.id_group_member');
    $this->db->where('id_member' , $id);
    $query = $this->db->get();

    foreach ($query->result() as $row)
    {
        $members["id_member"] =  $row->id_member;
        $members["login"] = $row->login;
        $members["actif"] = $row->actif;
        $members["email"] = $row->email;
        $members["id_group_member"] = $row->id_group_member;
        $members["name"] = $row->name;
    }

    return $members;

}




}

?>