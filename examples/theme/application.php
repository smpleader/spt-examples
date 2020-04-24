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
                    exit(0);
                case 'redirect':
                    // TODO add header for redirect
                    $redirect = self::get('redirect', '/');
                    $redirect_status = self::get('redirectStatus', '/');
                    if( headers_sent()){
                        echo '<script>document.location.href="'.$redirect.'"</script>';
                    }else{
                        $status = empty( $redirect_status ) ? 302 : (int) $redirect_status;
                        header( "Location: $redirect", true, $status );
                    }
                    exit(0);
                case '':
                    Log::add(
                        '<pre>',
                        application::data(),
                        application::token(),
                        '</pre>',
                    );
                    Log::show();
                    exit(0);
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