<?php
/**
 * SPT software - Shortcut functions
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Define some functions for simpler writing
 * 
 */

defined( 'SPT_PATH' ) or die('');

function setup($vars){
    return Config::init($vars);
}