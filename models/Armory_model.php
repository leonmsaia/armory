<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Armory_model extends CI_Model
{
    private $realm_db;

    public function __construct()
    {
        parent::__construct();

        // Base de datos del realm, revisar tu archivo database.php
        $this->realm_db = $this->load->database('characters', TRUE); // o 'characters'
    }

    public function getAllCharacters()
    {
        $query = $this->realm_db->query("
            SELECT guid, name, race, class, gender, level, totalKills, money
            FROM characters
            WHERE online = 0
            ORDER BY level DESC
            LIMIT 50
        ");
    
        return $query->result();
    }

    public function getCharacterByGuid($guid)
    {
        $query = $this->realm_db->query("
            SELECT guid, name, race, class, gender, level, totalKills, money
            FROM characters
            WHERE guid = ?
            LIMIT 1
        ", [$guid]);

        return $query->row();
    }

    public function getCharacterEquipment($guid)
    {
        // Equipamiento principal (slots 0-18)
        $query = $this->realm_db->query("
            SELECT ci.slot, ii.itemEntry
            FROM character_inventory ci
            JOIN item_instance ii ON ii.guid = ci.item
            WHERE ci.guid = ? AND ci.bag = 0 AND ci.slot BETWEEN 0 AND 18
            ORDER BY ci.slot ASC
        ", [$guid]);

        return $query->result();
    }
}
