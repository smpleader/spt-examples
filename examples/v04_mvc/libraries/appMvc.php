<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic Application implement mvc
 * 
 */

namespace Examples\v04_mvc\libraries; 

use SPT\App\DI\WebApp; 

class appMvc extends WebApp
{
    protected function getController($name)
    {
        $controllerName = '\Examples\v04_mvc\controllers\\'.$name;
        return new $controllerName($this);
    } 
}
