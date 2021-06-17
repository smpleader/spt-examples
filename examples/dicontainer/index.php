<?php
/**
 * SPT software - Demo application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: How we setup a website with Di container
 * 
 */

define('APP_PATH', __DIR__ . '/');

require APP_PATH.'/../../vendor/autoload.php';

use Examples\dicontainer\libraries\Starter;

$info = require_once 'info.php';

Starter::load()
    ->boot($info)
    ->run();