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
    ]
);

/**
 * Theme
 */
Theme::init('b4');

/**
 * Running application
 */
application::execute($router);