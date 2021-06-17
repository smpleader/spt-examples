<?php
/**
 * SPT software - Controller
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace Examples\dicontainer\libraries\Core;

defined( 'APP_PATH' ) or die('');

use SPT\Util;
use SPT\Log;
use SPT\Response;
use Examples\dicontainer\dicontainer as Theme;
use Examples\dicontainer\application;

class Controller extends Base
{
    use BaseTrait;

    public function display()
    {
        $layout = $this->app->get('layout', 'default');
        $file = $this->theme->getPath( $layout );
        if( false === $layout )
        {
            throw new Exception('View not found');
        }
        
        $this->theme->setBody(
            $this->view->render($file, $this->get())
        );
       
        Response::_( $this->theme->createPage(), 200 );
    }

    public function toJson()
    {
        Response::_( $this->get(), 200 );
    }

    public function toAjax()
    {
        $layout = $this->app->get('layout');
        $file = $this->theme->getPath( $layout );
        if( false === $layout )
        {
            die('View not found');
        }
        Response::_( $this->view->render($file, $this->get()), 200 );
    }
}
