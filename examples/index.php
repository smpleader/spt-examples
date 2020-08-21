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

require APP_PATH.'/../vendor/autoload.php';

use SPT\Router;
use SPT\Config;
use SPT\Log;

Config::init(
    [
        'siteSubpath' => 'examples'
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
    ]
);

Log::add(
    "\n<h1>Test in example folder</h1> <pre> \n",
    "\n<h2>Router ready:</h2> <pre> \n",
    Router::getVars(),
    '</pre>'
);

Log::add(
    "\n<h2>Task found:</h2> <pre> \n",
    $router->pathFinding('default.display'),
    '</pre>'
);

Log::show();

