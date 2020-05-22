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

require APP_PATH.'../../src/bootstrap.php';
require SPT_PATH.'router.php';
require SPT_PATH.'app.php';

/**
 * Application Bootstrap
 */
require 'application.php';

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