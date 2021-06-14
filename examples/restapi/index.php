<?php
/**
 * SPT software - Demo application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: How we setup a website
 * 
 */

define( 'APP_PATH', __DIR__ . '/');

require APP_PATH.'/../../vendor/autoload.php';
require_once 'functions.php';

use SPT\Config;
use SPT\Router;
use Examples\restapi\application;

Config::init(
    [
        'siteSubpath' => 'examples/restapi'
    ]
);

/**
 * Routing
 */
$router = Router::_(
    [ 
        'book/' => [
            'fnc'=> [
                'get' => 'restapi.get',
                'post' => 'restapi.post',
                'put' => 'restapi.put',
                'delete' => 'restapi.delete',
                'any' => 'restapi.any',
            ],
            'parameters' => ['id']
        ],
        'test-1/' => [
            'fnc'=> [
                'get' => 'restapi.get',
                'post' => 'restapi.post',
                'any' => 'restapi.any',
            ],
            'parameters' => ['id', 'uid']
        ],
        '' => ['fnc'=>'home.display', 'format'=> 'html'],
    ], 
    Config::get( 'siteSubpath')
); 

/**
 * Running application
 */
application::execute($router);