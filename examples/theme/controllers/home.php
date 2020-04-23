<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

defined( 'APP_PATH' ) or die('');

require 'controller.php';
require APP_PATH. 'models/model.php';

class homeController extends controller 
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
