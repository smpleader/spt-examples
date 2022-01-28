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

use SPT\StaticObj;
use SPT\Route;
use SPT\Log;

class Config extends StaticObj
{
    protected static $_vars;

    public static function init(array $vars)
    {
        foreach($vars as $key => $val)
        {
            if( !is_numeric($key) )
            {
                static::set($key, $val);
            }
        } 
    }
}

Config::init(
    [
        'siteSubpath' => 'examples/router',
        'endpoints' => [
            'testA' => 'a.test', 
            'test-ajax' => ['fnc'=>'home.testAjax', 'format'=>'ajax'],
            'test' => 'home.test', 
            '' => ['fnc'=>'home.display', 'format'=> 'html'],
        ],
    ],
    
);

/**
 * Test Route
 */
$route = new Route();
$route->init(
    Config::get('endpoints'), 
    Config::get( 'siteSubpath')
);

Log::add(
    "\n<h1>Route ready:</h1> <pre> \n",
    $route->get('sitemap'),
    '</pre>'
);

Log::add(
    "\n<h1>Task found:</h1> <pre> \n",
    $route->pathFinding('default.display'),
    '</pre>'
);

Log::show();
