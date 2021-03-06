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

use SPT\Config;
use SPT\Router;
use Examples\database\application;

Config::init(
    [
        'siteSubpath' => 'examples/database'
    ]
);

/**
 * Routing
 */
$router = Router::_(
    [
        'update-dbinfo' => ['fnc'=>'home.updateDbInfo', 'format'=>'html'],
        'prepare-db' => ['fnc'=>'home.prepareDb', 'format'=>'html'],
        'add-db' => ['fnc'=>'home.add', 'format'=>'html'],
        'remove-db' => ['fnc'=>'home.remove', 'format'=>'html'],
        '' => ['fnc'=>'home.display', 'format'=> 'html'],
    ]
);

/**
 * Running application
 */
application::execute($router);