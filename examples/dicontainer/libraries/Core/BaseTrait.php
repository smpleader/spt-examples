<?php
/**
 * SPT software - Application
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Base abstract implement Container
 * 
 */

namespace Examples\dicontainer\libraries\Core; 

use Joomla\DI\Container;
use Joomla\DI\ContainerAwareTrait;

trait BaseTrait
{ 
    protected $_vars = []; 

    public function get($key = null, $default = null)
    {
        if( null === $key ) return $this->_vars;
        return isset( $this->_vars[$key] ) ? $this->_vars[$key] : $default; 
    }

    public function set($key, $value)
    {
        $this->_vars[$key] = $value;
    }
}