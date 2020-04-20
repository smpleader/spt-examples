<?php
/**
 * SPT software - Log
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A way to log some information for admin
 * 
 */

defined( 'SPT_PATH' ) or die('');

class Log extends staticObj
{
    static protected $_vars = array();

    public static function add(){
        $arg_list = func_get_args();
        foreach($arg_list as $arg){
            self::$_vars[] = $arg;
        }
    }

    public static function show(){
        foreach( self::$_vars as $item ){
            print_r( $item );
            echo "\n";
        }
    }

    public static function toFile($name = null, $append = true){

        ob_start();
        self::show();
        $content = ob_get_clean();

        if( $content ){
            $content = 
                ">> START LOG ". date('Y-m-d H:i:s') . " << \n". 
                $content . 
                "\n--- LOGGED AT ".date('Y-m-d H:i:s')." ---\n";
    
            if( $name === null ) $name = APP_PATH. date('Y-m-d_His').'.log';
    
            if( $append ) {
                file_put_contents($name, $content, FILE_APPEND);
            } else {
                file_put_contents($name, $content);
            }
        }
    }
}
