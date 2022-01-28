<?php  defined('APP_PATH') or die('Invalid config');

return [ 
    'siteSubpath' => 'examples/mvc',
    'endpoints' =>
    [
        'test-json' => ['fnc'=>'home.testJson', 'format'=>'json'],
        'test-ajax' => ['fnc'=>'home.test', 'format'=>'ajax'],
        'test' => 'home.test', 
        'debug' => 'home.debug', 
        '' => ['fnc'=>'home.display', 'format'=> 'html'],
    ] 
];
