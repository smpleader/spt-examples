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
use SPT\Log;


Config::init(
    [
        'siteSubpath' => 'examples/router'
    ]
);

/**
 * Test Router
 */
$router = Router::_(
    [
        'testA' => 'a.test', 
        'test-ajax' => ['fnc'=>'home.testAjax', 'format'=>'ajax'],
        'test' => 'home.test', 
        '' => ['fnc'=>'home.display', 'format'=> 'html'],
    ], 
    Config::get( 'siteSubpath')
);

Log::add(
    "\n<h1>Router ready:</h1> <pre> \n",
    Router::getVars(),
    '</pre>'
);

Log::add(
    "\n<h1>Task found:</h1> <pre> \n",
    $router->pathFinding('default.display'),
    '</pre>'
);

Log::show();
