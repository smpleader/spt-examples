<?php
/**
 * SPT software - Bootstrap
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: We can implemet auto load here, but just make the minium of jobs
 * 
 */

defined( 'APP_PATH' ) or die('You must define Application path first');

define( 'SPT_PATH', __DIR__ . '/');

require_once 'baseObj.php';
require_once 'staticObj.php';
require_once 'util.php';
require_once 'config.php';
require_once 'log.php';