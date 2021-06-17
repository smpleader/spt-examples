<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Start up
 * 
 */

namespace Examples\dicontainer\libraries;

use Joomla\DI\Container;
use SPT\Lang;
use SPT\Util;
use SPT\Router;
use Examples\dicontainer\libraries\Core\Base;

class Starter extends Base
{
    protected static $_ins;
    public static function load()
    {
        if( null === self::$_ins )
        {
            self::$_ins = new self(new Container);
        }

        return self::$_ins;
    }

    public function boot(array $info)
    {
        
        $container = $this->getContainer();

        // Configuration
        $cfg = new \StdClass;
        foreach( $info['config'] as $key => $value )
        {
            $cfg->$key = $value;
        }
        $container->set('config', $cfg);

        // Router
        $container->set('router', Router::_($info['endpoint'], $info['siteSubpath']));
        
        // Providers
        foreach( $info['providers'] as $provider )
        {
            $provider = '\Examples\dicontainer\libraries\ServiceProvider\\'. $provider;
            $provider = new $provider;
            $provider->register($container);
        }

        // Debug
        if( isset($info['config']['debug']) &&
            isset($info['config']['debugMode']) &&
            'development' == $info['config']['debugMode']
        )
        {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        }
 
        // Language
        $lang = $container->get('app')->getCurrentLanguage();
        $lang_file = APP_PATH.'languages/'. $lang. '.php';
        $lang = require_once $lang_file;
        Lang::importArr($lang);

        return $this;
    }

    public function run()
    {
        try{

            $intruction = $this->router->pathFinding( $this->config->defaultEndpoint );

            $fnc = '';

            if( is_array($intruction) )
            {
                $fnc = $intruction['fnc'];
                unset($intruction['fnc']);
                foreach($intruction as $key => $value)
                {
                    $this->app->set($key, $value);
                }
            } 
            elseif( is_string($intruction) ) 
            {
                $fnc = $intruction;
            } 
            else 
            {
                throw new \Exception('Invalid request', 500);
            }

            $try = explode('.', $fnc);
            
            if(count($try) == 2 || $fnc == '')
            {
                list($controller, $function) = $try;
                $controller = ucfirst($controller). 'Controller';
            }
            else
            {
                $function = $fnc;
                $controller = 'HomeController';
            }

            if( $this->getContainer()->has($controller) )
            {
                $controller = $this->{$controller};
            }
            else
            {
                // TODO: create a default controller
                throw new \RuntimeException('Invalid Class '.$controller, 500);
            }

            $controller->$function();

            if( 'display' !== $function )
            {
                $controller->display();
            }

        }
        catch (Exception $e) 
        {
            die('[Error] ' . $e->getMessage());
        }
    }
}