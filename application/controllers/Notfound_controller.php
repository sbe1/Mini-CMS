<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotFound
 *
 * @author Shawn Ewald <shawn.ewald@gmail.com>
 */
class Notfound_controller {
    /**
     * Index action
     */
    public function index () {
        header('HTTP/1.1 404 Not Found');
        $data = ['page_title' => 'Mini-CMS: Controller or Method not found.'];
        $data['page_heading'] = 'Not Found.';
        $data['content'] = 'Controller or Method not found.';
        View::renderView('notfound', $data);
    }

}
