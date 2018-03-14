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

    // =======================================================================//
    // !                   Method for insert one states                      //
    // ======================================================================//
    public function insertStates($model)
    {
        $name_state = $model->getNameState();
        $this->db->set('name_state', $name_state)
                 ->insert($this->table);
    }



    // =======================================================================//
    // !             Method SELECT * payments method for datatable           //
    // ======================================================================//

    public function loadStatesDatatable()
    {
        $this->db->select('`id_state`, `name_state`,  `actif` ');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }


     // =======================================================================//
    // !            Method SELECT ALL states informations FOR MODAL          //
    // ======================================================================//
    public function selectAllStatesForModal($id)
    {

        $this->db->select('*')
            ->from($this->table)
            ->where('id_state', $id);

        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $states["id_state"] = $row->id_state;
            $states["name_state"] = $row->name_state;
            $states["actif"] = $row->actif;
        }

        return $states;
    }


    // =======================================================================//
    // !            Method for disable and enable an payment method           //
    // ======================================================================//

    public function disableEnableOneState($id)
    {
        $this->db->select('actif');
        $this->db->from($this->table);
        $this->db->where('id_state', $id);
        $query = $this->db->get();
        $result = $query->result_array();

        if ($result[0]['actif'] == 0) {

            $data = array('actif' => 1);
            $this->db->where('id_state', $id);
            $this->db->update($this->table, $data);
        } else {

            $data = array('actif' => 0);
            $this->db->where('id_state', $id);
            $this->db->update($this->table, $data);
        }
    }


    // =======================================================================//
    // !                      Method update an state by id                   //
    // ======================================================================//

    public function updateStates($model)
    {

        $id_state = $model->getIdState();
        $name_state = $model->getNameState();

        $this->db->set('name_state', $name_state);
        $this->db->where('id_state', $id_state);
        $this->db->update($this->table);
    }


}



?>
