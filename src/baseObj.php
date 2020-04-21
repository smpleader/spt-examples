<?php
/**
 * SPT software - Base Object
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic object
 * 
 */

defined( 'SPT_PATH' ) or die('');

class baseObj 
{
    protected $_vars;

    public function set($key, $value)
    {
        $this->$_vars[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return isset($this->$_vars[$key]) ? $this->$_vars[$key] : $default;
    }

    public function getVars()
    {
        return $this->$_vars;
    }
}
