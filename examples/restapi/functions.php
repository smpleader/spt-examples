<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic Application implement restapi
 * 
 */

use Examples\restapi\application;
 
function input($key, $value)
{
    application::data($key, $value, true);
}

function data($key, $default = null)
{
    return application::data($key, $default);
}

