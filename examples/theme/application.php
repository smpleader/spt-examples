<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic Application implement mvc
 * 
 */

defined( 'APP_PATH' ) or die('');

class application extends app 
{
    public static function execute($intruction){

        $fnc = '';

        if( is_array($intruction) )
        {
            $fnc = $intruction['fnc'];
            unset($intruction['fnc']);
            foreach($intruction as $key => $value)
            {
                self::set($key, $value);
            }
        } 
        elseif( is_string($intruction) ) 
        {
            $fnc = $intruction;
        } 
        else 
        {
            die('Invalid request.');
        }

        $try = explode('.', $fnc);
        
        if(count($try) == 2 || $fnc == '')
        {
            list($controller, $function) = $try;
        }
        else
        {
            $function = $fnc;
            $controller = 'home';
        }

        try{
            
            require APP_PATH.'/controllers/'. $controller. '.php';

            $controllerName = $controller.'Controller';
            $controller = new $controllerName;

            if( self::get('format') == 'ajax' )
            {
                $function = 'ajax'. ucfirst($function);
            }

            if( self::token() === null )
            {
                self::token([ Util::genToken(), strtotime('now') ]);
            }

            $controller->$function();

            $format = application::get('format', 'html');
            switch($format)
            {
                case 'html':

                    ob_start();
                    $controller->displayHtml();
                    $body = ob_get_clean();

                    self::set('body', $body);

                    Theme::createPage();

                    break;
                case 'ajax':
                    // TODO header for ajax
                    $controller->displayAjax();
                    break;
                case 'json':
                    header('Content-Type: application/json');
                    echo json_encode(application::data());
                    die(0);
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
            
            // keep alive after any hit
            self::token(strtotime('now'));

        }
        catch (Exception $e) 
        {
            die('System error: ' . $e->getMessage());
        }
    }
}
