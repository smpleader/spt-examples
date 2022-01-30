<?php
/**
 * SPT software - Basic demo
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: How we load the library and use a class
 * 
 */

define( 'APP_PATH', __DIR__ . '/');

require APP_PATH.'/../../vendor/autoload.php';

use SPT\StaticObj;
use SPT\Log;

class Data extends StaticObj
{
    protected static $_vars;
}

Log::set('key1', 123);
Data::set('key2', 'something here'); 

$a = [1,2,3];
$b = &$a;
$b[] = 5;

Log::add(
    '<pre>',
    Data::get('key2'),
    $a, 
    $b,
    '</pre>'
);

Log::show();
