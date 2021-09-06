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
error_reporting(E_ALL);
ini_set('display_errors', 1);

require APP_PATH.'/../../vendor/autoload.php';

use SPT\Config;
use SPT\Router;
use SPT\Util;
use Examples\theme\theme;
use Examples\theme\application;

Config::init(
    [
        'siteSubpath' => 'examples/theme'
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
    Config::get( 'siteSubpath')
);

/**
 * Language
 * We can save this in session
 */
$lange = Util::get('lang', 'en', 'get');
$availableLanguages = Config::get('availableLanguages', ['en', 'fr']);
if(!in_array($lange, $availableLanguages)){
    $lange = 'en';
}
require_once APP_PATH.'languages/'.$lange. '.php';

/**
 * Theme
 */
$theme = application::session('theme', 'b4');
if( isset($_GET['theme']))
{
    $new = Util::get('theme', 'b4', 'get');
    if( $new !=  $theme &&
        $new != 'widget' &&
        file_exists( APP_PATH. 'themes/'. $new. '/')
    ){
        $theme = $new;
        application::session('theme', $theme, true);
    }
}

define('THEME_PATH', APP_PATH. 'themes/'. $theme. '/' );

/**
 * Running application
 */
try{
    // Your code
    application::execute($router);
} 
catch(Error $e) {
   $trace = $e->getTrace();
   echo $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
}
