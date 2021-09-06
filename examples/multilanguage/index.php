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
use SPT\Util;
use Examples\multilanguage\application;

Config::init(
    [
        'siteSubpath' => 'examples/multilanguage'
    ]
);

/**
 * Routing
 */
$router = Router::_(
    [ 
        'default-page' => ['fnc'=>'home.display', 'layout' => 'default', 'format' => 'html'], 
        '' => ['fnc'=>'home.display', 'layout' => 'home', 'format'=> 'html'],
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
 * Running application
 */
application::execute($router);