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

use SPT\Router;
use Examples\mvc\libraries\application; 
use Examples\mvc\libraries\config;

config::init(
    [
        'siteSubpath' => 'examples/mvc'
    ]
);

/**
 * Routing
 */
$router = Router::_(
    [
        'test-json' => ['fnc'=>'home.testJson', 'format'=>'json'],
        'test-ajax' => ['fnc'=>'home.test', 'format'=>'ajax'],
        'test' => 'home.test', 
        'debug' => 'home.debug', 
        '' => ['fnc'=>'home.display', 'format'=> 'html'],
    ], 
    config::get( 'siteSubpath')
);

/**
 * Running application
 */
application::execute($router);