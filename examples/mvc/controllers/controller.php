<?php
/**
 * SPT software - Controller
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

defined( 'APP_PATH' ) or die('');

class controller extends baseObj 
{
    public function set($key, $value)
    {
        application::data($key, $value, true);
    }

    public function get($key, $default = null)
    {
        return application::data($key, $default);
    }

    public function display()
    {
        $format = application::get('format', 'html');
        switch($format)
        {
            case 'html': 
            case 'ajax':
            case 'json':
                $fnc = 'display'.ucfirst( strtolower($format) );
                $this->$fnc();
                break;
            case 'redirect':
                // TODO add header for redirect
                break;
            case '':
                Log::add(
                    '<pre>',
                    application::data(),
                    application::token(),
                    '</pre>',
                );
                Log::show();
                die();
                break;
        }
    }

    protected function displayHtml()
    {
        extract(application::data());
                
        $page = APP_PATH.'/views/html.'. application::get('layout', 'home').'.php';

        include $page;
    }

    protected function displayAjax()
    {
        extract(application::data());
                
        $page = APP_PATH.'/views/ajax.'. application::get('layout', 'home').'.php';

        include $page;

        die(0);
    }

    protected function displayJson()
    {
        header('Content-Type: application/json');

        echo json_encode(application::data());

        die(0);
    }
}
