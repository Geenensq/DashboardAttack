<?php
/**
 * Dashboard Attack, command manager
 * meanings_model.php
 * Coded with Codeigniter 3
 * @author Geenens Quentin <geenensq@gmail.com>
 * @version 1.0
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Meanings_model extends CI_Model
{
    private $id_meaning;
    private $meaning_name;
    private $actif;
    protected $table = "meanings";

    // =======================================================================//
    // !                     Start methods getters                           //
    // ======================================================================//

    public function getIdMeaning()
    {
        return $this->id_meaning;
    }

    public function getMeaningName()
    {
        return $this->meaning_name;
    }

    public function getActif()
    {
        return $this->actif;
    }

    public function getTable()
    {
        return $this->table;
    }

    // =======================================================================//
    // !                     Start methods setters                           //
    // ======================================================================//

    public function setIdMeaning($id_meaning)
    {
        $this->id_meaning = $id_meaning;

        return $this;
    }

    public function setMeaningName($meaning_name)
    {
        $this->meaning_name = $meaning_name;

        return $this;
    }

    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    // =======================================================================//
    // !                     Start CRUD methods                              //
    // ======================================================================//

    public function selectAll()
    {
        $arrayMeanings = [];
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        foreach ($query->result_object() as $ligne) {
            $meanings = new Meanings_model();
            $meanings->setIdMeaning($ligne->id_meaning);
            $meanings->setMeaningName($ligne->meaning_name);
            $arrayMeanings[] = $meanings;
        }
        return $arrayMeanings;

    }

}
