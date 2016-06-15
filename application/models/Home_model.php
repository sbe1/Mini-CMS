<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home_model
 *
 * @author Shawn Ewald <shawn.ewald@gmail.com>
 */
class Home_model {
    private $config;
    private $model;
    public function __construct () {
        $this->config = Config::getInstance();
        $db = JSONFileDB::getInstance($this->config->getConfig('data_dir').$this->config->getConfig('data_filename'));
        $this->model = $db->selectOne('pages','page','=','home');
    }
    /**
     * Return model data
     * @return array
     */
    public function getData () {
        return $this->model;
    }
}
