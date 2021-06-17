<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Base abstract implement Container
 * 
 */

namespace Examples\dicontainer\libraries\ServiceProvider; 

use SPT\Util;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface; 
use Examples\dicontainer\libraries\Core\Theme;

class ThemeServiceProvider implements ServiceProviderInterface
{
    public function boot(Container $container)
    {
        $session = $container->get('session');
        $theme = $session->get('theme', 'b4');
        if( isset($_GET['theme']))
        {
            $new = Util::get('theme', 'b4', 'get');
            if( $new !=  $theme &&
                $new != 'widget' &&
                file_exists( APP_PATH. 'views/themes/'. $new. '/')
            ){
                $theme = $new;
                $session->set('theme', $theme);
            }
        }

        define('THEME_PATH', APP_PATH. 'views/themes/'. $theme. '/' );

        // TODO: register asset
    }

    public function register(Container $container)
    {
        $this->boot($container);
        $container->share(
            'Examples\dicontainer\libraries\Core\Theme',
            function () use ($container)
            {
                return new Theme($container);
            },
            true
        );

        $container->alias('theme', 'Examples\dicontainer\libraries\Core\Theme');
    }
}