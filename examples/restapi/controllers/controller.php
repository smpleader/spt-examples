<?php
/**
 * SPT software - Controller
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace Examples\restapi\controllers;

defined( 'APP_PATH' ) or die('');

use SPT\Config; 
use SPT\Log; 
use Examples\restapi\application;
use \input, \data;

class controller
{
    public function display()
    {
       // ..
    }

    public function displayHtml()
    {
        $_layout_file = application::get('layout', 'home');
        if( strpos($_layout_file, '/') !== 'false') $_layout_file = 'html.'. $_layout_file;

        $_layout_path = '';
        if(defined('THEME_PATH'))
        {
            $_layout_path = THEME_PATH.'/views/'. $_layout_file .'.php';
            if(!file_exists($_layout_path))
            {
                $_layout_path = '';
            }
        }

        if($_layout_path == '')
        {
            $_layout_path = APP_PATH.'/views/'. $_layout_file .'.php';
        }

        extract(application::data());
        include $_layout_path;
    }

    public function displayAjax()
    {
        $_layout_file = application::get('layout', 'home');
        if( strpos($_layout_file, '/') !== 'false') $_layout_file = 'ajax.'. $_layout_file;

        extract(application::data());
        include APP_PATH.'/views/'. $_layout_file .'.php';

        die(0);
    }
}
