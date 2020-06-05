<?php
/**
 * SPT software - Application Object
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic object
 * 
 */

defined( 'SPT_PATH' ) or die('');

class app extends staticObj
{
    protected static $_vars = array();
    protected static $_data = array();

    private static function _data($data, $key = null, $value = null, $format = 0)
    {
        switch($data)
        {
            case 'session': $storage = &$_SESSION; break;
            default: $storage = &self::$_data; break;
        }

        $numargs = func_num_args();
        $numargs --;
        switch($numargs){
            case 0: return $storage;
            case 1: 
            case 2: 
                return isset($storage[$key]) ? $storage[$key] : $value;
            case 3: 
                if($format === true)
                {
                    $storage[$key] = $value;
                }
            break;
        }

        if(is_string($format))
        {
            return Util::get($key, $format, $storage);
        }
         
    }

    public static function data($key = null, $value = null, $format = 0)
    {
        $arr = func_get_args();
        array_unshift( $arr, 'data');

        return forward_static_call_array( [__CLASS__, '_data'], $arr);
    }

    /**
     * TODO: load Session from database
     */
    public static function session($key = null, $value = null, $format = 0)
    {
        if(session_id() == '' || !isset($_SESSION)) {
            // session isn't started
            session_start();
        }
        $arr = func_get_args();
        array_unshift( $arr, 'session');

        return forward_static_call_array( [__CLASS__, '_data'], $arr); 
    }

    public static function token($param = null){

        if( is_null($param)){

            return self::session('token', null);

        } elseif ( $param == 'validPost' || $param == 'validGet'){

            $tmp = ( $param == 'validPost' ) ? $_POST : $_GET;
            $token = self::token(); 
            $passed = isset($tmp[$token])  && $tmp[$token] == 1;
            if( $passed ){
               return self::token('isAlive');
            }
            return false;
        
        } elseif ( $param == 'isAlive'){

            $expire = self::session('token_timeout', 0);
            $now = strtotime("now");
            return $expire > $now;

        } elseif ( is_array($param)){

            self::session('token', $param[0], true);
            self::token( (int)$param[1] );

        } elseif ( is_int($param)){

            $param += 60 * Config::get('sessionTimeout', 15);
            self::session('token_timeout', $param, true);

        }
    }

    public static function execute($router){

    }
}
