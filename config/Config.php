<?php

require_once 'autoload.php';

class Config {
    private static $instance = null;
    private static $config;
    const DEFAULT_CONTROLLER_METHOD = 'index';
    public static function getInstance () {
        if (self::$instance == null) {
            $appConfig = [];
            include_once 'app_config.php';
            self::$config = $appConfig;
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function getConfig ($key) {
        return isset(self::$config[$key]) ? self::$config[$key] : null ;
    }

}