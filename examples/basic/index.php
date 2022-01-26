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
use SPT\Log;

class Data extends StaticObj
{
    protected static $_vars;
}

/**
 * Test Log, Data
 */

Log::set('key1', 123);
Data::set('key2', 'something here'); 

$a = [1,2,3];
$b = &$a;
$b[] = 5;

Log::add(
    '<pre>',
    Data::get('key2')
    ,$a ,$b,
    '</pre>'
);

Log::show();
