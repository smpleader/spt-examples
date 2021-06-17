<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Create a theme for this app
 * 
 */

namespace Examples\dicontainer\libraries\Core;

defined( 'APP_PATH' ) or die('');

define( 'WIDGET_PATH', APP_PATH. 'widgets/');

use SPT\App;
use SPT\Util;
use SPT\Log;
use Examples\dicontainer\application;

class Theme extends Base
{
    protected $_body;

    public function getPath($name, $default = 'index')
    {
        $try = [
            THEME_PATH. $name. '.php',
            THEME_PATH. $name. '/'. $default. '.php',
            APP_PATH. 'views/layouts/'. $name. '.php',
            APP_PATH. 'views/layouts/'. $name. '/'. $default. '.php'
        ];

        foreach($try as $file)
        {
            if(file_exists($file)) return $file;
        }

        //TODO hook for layout override

        return false;
    }

    public function setBody($body)
    {
        $this->_body = $body;
    }

    public function getBody()
    {
        return $this->_body;
    }

    public function createPage()
    {
        $page = $this->app->get('page', 'index');

        $file = $this->getPath($page);
        if( false === $file )
        {
            throw new Exception('Invalid theme');
        }

        include $file;
    }

    public function createWidget($name, $data = array())
    {
        $file = $this->getPath('widgets/'. $name);
        if( false === $file )
        {
            return '<!--widget '. $name. ' not found-->';
        }

        return $this->view->render($file, $data);
    }
}