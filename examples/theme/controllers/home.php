<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace Examples\theme\controllers;

defined( 'APP_PATH' ) or die('');

use Examples\theme\models\model;
use Examples\theme\application;

class home extends controller 
{
    public function test()
    {
        application::set('format', 'ajax');
        $this->set('vars', 123456);
    }
    
    public function ajaxTest()
    {
        $this->set('vars', 0);
    }

    public function default()
    {
        application::set('layout', 'default');
    }

    public function debug()
    {
        application::set('format', '');
        $this->set('vars', 'debug shown');
    }
}
