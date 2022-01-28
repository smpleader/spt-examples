<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic Application implement mvc
 * 
 */

namespace Examples\mvc\libraries; 

use SPT\App;
use SPT\Util;
use SPT\Support\Token;
use SPT\App\DI\WebApp;
use SPT\BaseObj;
use SPT\Response;
use SPT\MagicObj;
use SPT\Query;
use SPT\Route as Router;
use SPT\Extend\Pdo as PdoWrapper;
use SPT\Storage\FileArray;
use SPT\Storage\FileIni;
use SPT\Session\PhpSession;
use SPT\Session\DatabaseSession;
use SPT\Session\DatabaseSessionEntity;
use SPT\Session\Instance as Session;
use SPT\App\Instance as AppIns;
use SPT\App\Adapter;
use SPT\Request\Base as Request;

class appMvc extends WebApp
{
    protected function getController($name)
    {
        $controllerName = '\Examples\mvc\controllers\\'.$name;
        return new $controllerName($this);
    } 
}
