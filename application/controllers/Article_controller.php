<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Article_model
 *
 * @author Shawn Ewald <shawn.ewald@gmail.com>
 */
class Article_controller {
    private $config;
    public function __construct () {
        $this->config = Config::getInstance();
    }
    /**
     * Index action
     * @param array $uriData
     */
    public function index ($uriData) {
        $model = new Article_model();
        View::renderView('article',$model->getModel());
    }
    /**
     * Load and render article
     * @param array $uriData
     */
    public function loadArticle ($uriData) {
        $model = new Article_model();
        View::renderView('article',$model->getArticle($uriData[1]));
    }
}
