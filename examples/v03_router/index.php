<?php
/**
 * SPT software - Demo application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: How we routing based current URL
 * 
 */

define( 'APP_PATH', __DIR__ . '/');

require APP_PATH.'/../../vendor/autoload.php';

use SPT\Route as Router;
use SPT\Log; 

$router = new Router();
$router->init(
    [
        'testA' => 'a.test', 
        'test-ajax' => ['fnc'=>'home.testAjax', 'format'=>'ajax'],
        'test' => 'home.test', 
        '' => ['fnc'=>'home.display', 'format'=> 'html'],
    ], 
    'examples/03_router'
);

Log::add(
    "\n<h1>Router ready:</h1> <pre> \n",
    $router->getAll(),
    '</pre>'
);

Log::add(
    "\n<h1>Task found:</h1> <pre> \n",
    $router->pathFinding('default.display'),
    '</pre>'
);

Log::show();
