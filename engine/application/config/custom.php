<?php
defined('BASEPATH') OR exit('No direct script access allowed');
switch (ENVIRONMENT){
    case 'production':
        $config['service_auth_url'] = 'http://172.18.2.41:8080/service/';
        break;
    default:
        $config['service_auth_url'] = 'http://localhost/~marwansaleh/authentication/service/';
}


$config['assets_path'] = 'static/resources/themes/';
$config['plugins_path'] = 'static/resources/plugins/';
$config['agenda_doc_path'] = 'static/userdata/agenda/';