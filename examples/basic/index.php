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
require SPT_PATH.'config.php';
require SPT_PATH.'log.php'; 


/**
 * Test Log, Config
 */

Log::set('key1', 123);
Config::set('key2', 'something here'); 

Log::add(
    Config::get('key2')
);

Log::show();
