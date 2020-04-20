<?php
/**
 * SPT software - Array
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: All function work with Array to simplify the jobs
 * 
 */

defined( 'SPT_PATH' ) or die('');

class Util{

    public static function genToken( $type = 'alnum', $length = 12 )
    {
        switch ( $type ) {
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'hexdec':
                $pool = '0123456789abcdef';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
            case 'distinct':
                $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
                break;
            default:
                $pool = (string) $type;
                break;
        }


        $crypto_rand_secure = function ( $min, $max ) {
            $range = $max - $min;
            if ( $range < 0 ) return $min; // not so random...
            $log    = log( $range, 2 );
            $bytes  = (int) ( $log / 8 ) + 1; // length in bytes
            $bits   = (int) $log + 1; // length in bits
            $filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
            do {
                $rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes ) ) );
                $rnd = $rnd & $filter; // discard irrelevant bits
            } while ( $rnd >= $range );
            return $min + $rnd;
        };

        $token = "";
        $max   = strlen( $pool );
        for ( $i = 0; $i < $length; $i++ ) {
            $token .= $pool[$crypto_rand_secure( 0, $max )];
        }
        return $token;
    }

    public static function get($var, $type='', $from='get'){

        if(is_string($from)){
            switch($from){
                case 'post':
                case 'POST':
                    $from = $_POST;
                    break;
                case 'get':
                case 'GET':
                    $from = $_GET;
                    break;
                default:
                    $find = self::get($var, $type, 'post');
                    return $find === null ? self::get($var, $type, 'get') : $find;
                    break;
            }
        }

        if( !isset($from[$var]) ) return null;

        $type = strtolower($type);
        switch($type){
            case 'int':
            case 'integer':
                return (int) $from[$var];
            case 'float':
            case 'double':
                return (float) $from[$var];
            case 'bool':
            case 'boolean':
                return (bool) $from[$var];
            case 'email':
                return filter_var($from[$var], FILTER_VALIDATE_EMAIL);
            case 'word':
                return preg_replace('/[^A-Z_]/i', '', $from[$var]);
            case 'alnum':
                return preg_replace('/[^A-Z0-9]/i', '', $from[$var]);
            case 'array':
                return (array) $from[$var];
            case 'cmd': // Allow a-z, 0-9, underscore, dot, dash. Also remove leading dots from result. 
                return preg_replace('/[^A-Z0-9_\.-]/i', '', $from[$var]);
            case 'base64': // Allow a-z, 0-9, slash, plus, equals.
                return preg_replace('/[^A-Z0-9\/+=]/i', '', $from[$var]);
           default: // raw
                return $from[$var];
        }
    }
}