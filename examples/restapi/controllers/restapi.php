<?php
/**
 * SPT software - restapiController
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
use \input, \data;

class restapi extends controller 
{
    public function any()
    {
        input('request-data', $_REQUEST);
        input('post-data', $_POST);
        input('get-data', $_GET);
        input('url-data', application::get('urlVars'));
        input('message', 'You requested something, and we send default');
    }
    
    public function processGet()
    {
        input('get-data', $_GET);
        input('url-data', application::get('urlVars'));
        input('message', 'You requested to see detail');
    }

    public function post()
    {
        input('post-data', $_POST);
        input('url-data', application::get('urlVars'));
        input('message', 'You requested to create new');
    }

    public function put()
    {
        input('post-data', $_POST);
        input('url-data', application::get('urlVars'));
        input('message', 'You requested to update an existing');
    }

    public function delete()
    {
        input('url-data', application::get('urlVars'));
        input('message', 'You requested to delete');
    }
}
