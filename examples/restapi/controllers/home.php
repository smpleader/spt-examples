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

    public function default()
    {
        application::set('httpResponseCode', 404);
        application::set('layout', 'default');
    }

    public function display()
    {
        application::set('layout', 'home');
        application::set('format', 'html');
    }
}
