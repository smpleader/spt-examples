<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Create a simple session
 * 
 */

namespace Examples\dicontainer\libraries\Core;

defined( 'APP_PATH' ) or die('');

use SPT\App;
use SPT\Util;

class SimpleSession
{
    public function ___construct()
    {
        if( null === App::token() )
        {
            App::token([ Token::generate(), strtotime('now') ]);
        }
    }

    public function keepAlive()
    {       
        // keep alive after any hit
        App::token(strtotime('now'));
    }

    public function get($key, $default = null)
    {
        return App::session($key, $default); 
    }

    public function set($key, $value)
    {
        App::session($key, $value, true); 
    }
}