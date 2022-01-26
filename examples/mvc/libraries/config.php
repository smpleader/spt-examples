<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic Application implement mvc
 * 
 */

namespace Examples\mvc\libraries; 

use SPT\StaticObj; 

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