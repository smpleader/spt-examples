<?php
/**
 * SPT software - Static Object
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a static singleton object
 * 
 */

defined( 'SPT_PATH' ) or die('');

class staticObj 
{
    static function set($key, $value, $overwrite = true)
    {
        if( $overwrite || !isset( static::$_vars[$key] ) )
        {
            static::$_vars[$key] = $value;
        }
    }

    static function get($key, $default = null)
    {
        return isset(static::$_vars[$key]) ? static::$_vars[$key] : $default;
    }

    static function getVars()
    {
        return static::$_vars;
    }

    static function importArr(array $arr)
    {
        fncArray::merge(static::$_vars, $arr);
    }
}
