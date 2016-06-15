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
class Home_controller {
    /**
     * Index action
     * @param type $uriData
     */
    public function index ($uriData) {
        $model = new Home_model();
        View::renderView('home',$model->getData());
    }
}
