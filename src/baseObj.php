<?php
/**
 * SPT software - Base Object
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a static singleton object
 * 
 */

defined( 'SPT_PATH' ) or die('');

class baseObj 
{
    static function set($key, $value){
        static::$_vars[$key] = $value;
    }

    static function get($key, $default=null){
        return isset(static::$_vars[$key]) ? static::$_vars[$key] : $default;
    }
}
