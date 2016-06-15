<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Error_controller
 *
 * @author Shawn Ewald <shawn.ewald@gmail.com>
 */
class Error_controller {
    /**
     * Index action
     * @param Exception $e
     */
    public function index (Exception $e) {
        $data = ['page_title'=>'Mini-CMS: ERROR'];
        $data['page_heading'] = 'ERROR';
        $data['content'] = $e->getMessage();
        View::renderView('error',$data);
    }
}
