<?php
/**
 * Dashboard Attack, command manager
 * messages_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Messages_model extends CI_Model
{
// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
    private $id_message;
    private $text_message;
    private $date_message;
    private $id_member;
    private $table = "messages";


// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//

    public function getIdMessage()
    {
        return $this->id_message;
    }

    public function getTextMessage()
    {
        return $this->text_message;
    }

    public function getDateMessage()
    {
        return $this->date_message;
    }

    public function getIdMember()
    {
        return $this->id_member;
    }

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//


    public function setIdMessage($id_message)
    {
        $this->id_message = $id_message;

        return $this;
    }

    public function setTextMessage($text_message)
    {
        $this->text_message = $text_message;

        return $this;
    }

    public function setDateMessage($date_message)
    {
        $this->date_message = $date_message;

        return $this;
    }

    public function setIdMember($id_member)
    {
        $this->id_member = $id_member;

        return $this;
    }


// =======================================================================//
// !                     Start CRUD methods                              //
// ======================================================================//

// =======================================================================//
// !                  Method select messages for chat                    //
// ======================================================================//

    public function selectMessagesTchat(){

        $this->db->select("messages.id_message , text_message , date_message , messages.id_member , members.login AS member");
        $this->db->from($this->table);
        $this->db->join('members' , 'messages.id_member = members.id_member');
        $this->db->order_by('messages.id_message', 'DESC');
        $this->db->limit('20');
        $query = $this->db->get();

        return $query->result_array();
    }

// =======================================================================//
// !                  Method for insert one message in chat              //
// ======================================================================//

    public function insertOneMessage($model){
        $id_member = $model->getIdMember();
        $text_message = $model->getTextMessage();

        $this->db->set('date_message', 'NOW()', FALSE)
        ->set('id_member', $id_member)
        ->set('text_message' , $text_message)
        ->insert($this->table);

    }












}
