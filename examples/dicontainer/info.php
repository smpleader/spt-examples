<?php defined('APP_PATH') or die();
// initialized information to boot up
return [
    'providers' => [
        'AppServiceProvider',
        'ThemeServiceProvider'
    ],
    'config' => [
        'defaultEndpoint' => 'home.show',
        'siteSubpath' => 'examples/dicontainer',
        'availableLanguages' => ['en', 'fr']
    ],
    'endpoint' => [
        'test-json' => ['fnc'=>'home.testJson', 'format'=>'json'],
        'test-ajax' => ['fnc'=>'home.test', 'format'=>'ajax'],
        'test' => 'home.test', 
        'default-page' => 'home.default', 
        'debug' => 'home.debug'
    ]
];