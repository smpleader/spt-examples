<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Create a theme for this app
 * 
 */

namespace Examples\theme;

defined( 'APP_PATH' ) or die('');

define( 'WIDGET_PATH', APP_PATH. 'widgets/');

use SPT\App;
use SPT\Util;
use SPT\Log;
use Examples\theme\application;

class theme extends \SPT\Theme 
{
    static protected $_vars = array();

    public static function createPage($page='', $data = array())
    {
        if( '' === $page)
        {
            $page = application::get('page', 'index');
        }

        include THEME_PATH. $page. '.php';
    }

    public static function echoWidget($name, $data = array())
    {
        $try = THEME_PATH. 'widgets/'. $name. '/index.php';
        if(!file_exists($try))
        {
            $try = WIDGET_PATH. $name. '/index.php';
        } 

        if(file_exists( $try))
        {
            ob_start();
            include $try;
            echo  ob_get_clean();
        }
    }
}