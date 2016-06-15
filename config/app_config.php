<?php
# System config
$appConfig['root_dir'] = realpath('..');
$appConfig['app_dir'] = $appConfig['root_dir'].'/application/';
$appConfig['lib_dir'] = $appConfig['app_dir'].'lib/';
$appConfig['view_dir'] = $appConfig['app_dir'].'views/';
$appConfig['web_dir'] = $appConfig['root_dir'].'/www/';
$appConfig['data_dir'] = $appConfig['root_dir'].'/data/';
$appConfig['data_filename'] = 'cms.json';


# User Editable variables
$appConfig['site_name'] = 'Mini-CMS';