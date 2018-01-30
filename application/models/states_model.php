<?php
/**
 * Dashboard Attack, command manager
 * states_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

    Class states_model extends CI_Model
    {

// =======================================================================//
// !                  Declaration of my attributes                       //
// ======================================================================//
        private $id_state;
        private $name_state;
        public $table = "states";
// =======================================================================//
// !                     Start methods getters                           //
// ======================================================================//
    public function getIdState()
    {
        return $this->id_state;
    }

    public function getNameState()
    {
        return $this->name_state;
    }

// =======================================================================//
// !                     Start methods setters                           //
// ======================================================================//
    public function setIdState($id_state)
    {
        $this->id_state = $id_state;

        return $this;
    }

    public function setNameState($name_state)
    {
        $this->name_state = $name_state;

        return $this;
    }
// =======================================================================//
// !                      Start methods CRUDS                            //
// ======================================================================//

// =======================================================================//
// !                         Method SELECT * states                      //
// ======================================================================//

    public function selectAll()
    {
        $arrayStates = [];
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

            foreach ($query->result_object() as $ligne)
            {
                    $states = new States_model();
                    $states->setIdState($ligne->id_state);
                    $states->setNameState($ligne->name_state);
                    $arrayStates[] = $states;
            }
                    return $arrayStates;
    }











}



?>
