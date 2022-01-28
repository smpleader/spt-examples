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

use SPT\App\Instance as AppIns;
use Examples\mvc\libraries\appMvc;

/**
 * Running application
 */
AppIns::bootstrap( new appMvc(),[
    'app' => APP_PATH,
    'config' => APP_PATH. 'config.php',
    'view' => APP_PATH. 'views/', 
]);

AppIns::main()->execute();