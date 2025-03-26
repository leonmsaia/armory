<?php
/**
 * Armory Plugin
 *
 * @author Leon M. Saia
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Armory extends BS_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_login();
        $this->load->model('armory_model');
        $this->load->helper('armory');
    }

    public function index()
    {
        $data['characters'] = $this->armory_model->getAllCharacters();
        $this->template->build('index', $data);
    }

    public function view($guid = null)
    {
        if (!$guid || !is_numeric($guid)) {
            show_404();
        }

        $character = $this->armory_model->getCharacterByGuid($guid);
        if (!$character) {
            show_404();
        }

        $equipment = $this->armory_model->getCharacterEquipment($guid);

        $data['character'] = $character;
        $data['equipment'] = $equipment;

        $this->template->build('view', $data);
    }

}
