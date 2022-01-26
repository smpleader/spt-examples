<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic Application implement mvc
 * 
 */
namespace Examples\database;

use SPT\StaticObj;

defined( 'APP_PATH' ) or die('');

class config extends StaticObj
{
    protected static $_vars;

    public static function init(array $vars)
    {
        foreach($vars as $key => $val)
        {
            if( !is_numeric($key) )
            {
                static::set($key, $val);
            }
        } 
    }
}