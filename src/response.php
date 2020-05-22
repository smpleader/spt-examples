<?php
/**
 * SPT software - Response
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A way to log some information for admin
 * 
 */

defined( 'SPT_PATH' ) or die('');

class Response extends staticObj
{
    static protected $_vars = array();

    public static function _($content=false)
    {
        if($content) echo $content;
        exit(0);
    }

    // okie
    public static function _200($msg='')
    {
        http_response_code('200');
        self::_($msg);
    }

    // unauthorised
    public static function _401($msg='')
    {
        http_response_code('401');
        self::_($msg);
    }

    // not found
    public static function _404($msg='')
    {
        http_response_code('404');
        self::_($msg);
    }

    // Forbidden
    public static function _403($msg='')
    {
        http_response_code('403');
        self::_($msg);
    }

    // internal error
    public static function _500($msg='')
    {
        http_response_code('500');
        self::_($msg);
    }
}
