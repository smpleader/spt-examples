<?php
/**
 * SPT software - Object
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: All function work with Object to simplify the jobs
 * 
 */

defined( 'SPT_PATH' ) or die('');

class fncObject
{
    public static function merge(&$obj1, $obj2)
    {
        foreach($obj2 as $key => $value)
        {
            if(is_object($value)){
                fncObject::merge($obj1->$key, $value);
            } else {
                $obj1[$key] = $value;
            }
        }
    }

    
}
