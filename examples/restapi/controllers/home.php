<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace Examples\restapi\controllers;

defined( 'APP_PATH' ) or die('');

use Examples\restapi\models\model;
use Examples\restapi\application;

class home extends controller 
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
