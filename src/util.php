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
        elseif(is_object($from))
        {
            $from = (array)$from;
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

    public static function uc( $word )
    {
        return ucfirst( strtolower($word) );
    }

    public function getClientIp() {
        $ipaddress = '';
        if (getenv('X-Real-IP'))
            $ipaddress = getenv('X-Real-IP');
        else if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function jdecode($string)
    {
        $body = @json_decode($string);

        if(json_last_error() !== JSON_ERROR_NONE)
        {
            $err = '';
            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    $err = ' - No errors';
                break;
                case JSON_ERROR_DEPTH:
                    $err = ' - Maximum stack depth exceeded';
                break;
                case JSON_ERROR_STATE_MISMATCH:
                    $err = ' - Underflow or the modes mismatch';
                break;
                case JSON_ERROR_CTRL_CHAR:
                    $err = ' - Unexpected control character found';
                break;
                case JSON_ERROR_SYNTAX:
                    $err = ' - Syntax error, malformed JSON';
                break;
                case JSON_ERROR_UTF8:
                    $err = ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                break;
                default:
                    $err = ' - Unknown error';
                break;
            }
            // TODO: block bad IP
            // TODO: log this issue 
            Log::add($err);
            return '';
        }
        return $body;
    }
}
