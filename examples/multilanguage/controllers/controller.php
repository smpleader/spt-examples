<?php
/**
 * SPT software - Controller
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */
namespace Examples\multilanguage\controllers;

defined( 'APP_PATH' ) or die('');

use SPT\BaseObj; 
use SPT\Config; 
use SPT\Log; 
use Examples\multilanguage\application;

class controller extends BaseObj 
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

    public function email( $to , $subject , $body, $from){

        ob_start();
        include APP_PATH.'/views/mail.'.$body.'.php';
        $message = ob_get_clean();

        $headers[] = 'MIME-Version: 1.0';
        if(Config::get('mailSupportHTML', 0))
        {
            $headers[] = 'Content-type: text/html; charset=UTF-8';
        }

        if( $cc = Config::get('mailCC', 0))
        {
            $headers[] = 'Cc: '.$cc;
        }

        if( $bcc = Config::get('mailBCC', 0))
        {
            $headers[] = 'Bcc: '.$bcc;
        }
        //$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
        $headers[] = 'To: '. $to.' <'.$to.'>';
        $headers[] = 'From: '. Config::get('mailFrom', 'Example SPT Software') .' <'. $from .'>';
        
        @mail ( $to , $subject , $message , implode("\r\n", $headers));
    }
}
