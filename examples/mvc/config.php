<?php  defined('APP_PATH') or die('Invalid config');

return [ 
    'siteSubpath' => 'examples/mvc',
    'defaultEndpoint' => 'home.display',
    'endpoints' =>
    [
        'test-json' => ['fnc'=>'home.testJson', 'format'=>'json'],
        'test-ajax' => ['fnc'=>'home.testAjax', 'format'=>'ajax'],
        'test-default' => ['fnc'=>'home.default', 'format'=>'html'],
        'test' => 'home.test', 
        '' => ['fnc'=>'home.display', 'format'=> 'html'],
    ] 
];
