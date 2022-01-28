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
        echo 'This is a base process: echo a sentence.';
    }

    public function testJson()
    {
        $this->set('vars', 'It works');
        $this->set('more_vars', 'We set this in the controller');
    }

    public function testAjax()
    {
        $this->set('vars', 12323345);
        $this->app->set('layout', 'ajax');
    }

    public function display()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'home');
    }

    public function default()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'default');
    }
}
