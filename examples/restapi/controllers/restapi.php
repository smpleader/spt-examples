<?php
/**
 * SPT software - restapiController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

defined( 'APP_PATH' ) or die('');

require 'controller.php';
require APP_PATH. 'models/model.php';

class restapiController extends controller 
{
    public function any()
    {
        $this->set('request-data', $_REQUEST);
        $this->set('post-data', $_POST);
        $this->set('get-data', $_GET);
        $this->set('url-data', application::get('urlVars'));
        $this->set('message', 'You requested something, and we send default');
    }
    
    public function get()
    {
        $this->set('get-data', $_GET);
        $this->set('url-data', application::get('urlVars'));
        $this->set('message', 'You requested to see detail');
    }

    public function post()
    {
        $this->set('post-data', $_POST);
        $this->set('url-data', application::get('urlVars'));
        $this->set('message', 'You requested to create new');
    }

    public function put()
    {
        $this->set('post-data', $_POST);
        $this->set('url-data', application::get('urlVars'));
        $this->set('message', 'You requested to update a existing');
    }

    public function delete()
    {
        $this->set('url-data', application::get('urlVars'));
        $this->set('message', 'You requested to delete');
    }
}
