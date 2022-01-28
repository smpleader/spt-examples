<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace Examples\mvc\controllers;

defined( 'APP_PATH' ) or die('');

use Examples\mvc\models\model;
use Examples\mvc\libraries\application;
use SPT\MVC\DI\Controller;

class home extends Controller 
{
    public function test()
    {
        $this->app->set('format', 'ajax');
        $this->set('vars', 123456);
    }

    public function testJson()
    {
        $this->set('vars', 'it works');
    }

    public function ajaxTest()
    {
        $this->set('vars', 0);
    }

    public function default()
    {
        $this->app->set('layout', 'default');
    }

    public function debug()
    {
        $this->app->set('format', '');
        $this->set('vars', 'debug shown');
    }
}
