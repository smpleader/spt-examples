<?php
/**
 * SPT software - Theme
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A way to log some information for admin
 * 
 */

defined( 'SPT_PATH' ) or die('');

class Theme extends staticObj
{
    static protected $_vars = array();
    //static protected $_widgets = array();
    static protected $_theme = '';

    public static function add(string $link, $dependencies = array(), $id = '')
    {
        if(empty($dependencies)) $dependencies = array();
        else  $dependencies = (array) $dependencies;
        $asset = new Asset($link, $dependencies);
        $type = $asset->getType();

        if(!empty($id))
        {
            $asset->set('id', $id );
        }
        $id = $asset->get('id');

        self::importArr([
            $type => [ $id => $asset ]
        ]);
    }

    public static function addInline(string $type, string $lines)
    {
        self::importArr([
            'inline'. Util::uc($type) => [ $lines ]
        ]);
    }

    public static function echo($type)
    {
        echo implode("\n", self::generate($type));
    }

    public static function generate($type)
    {
        $output = []; 

        if( strpos($type, 'inline') === 0 )
        {
            $tag = '';
            $output = self::get($type);
            switch($type)
            {
                case 'inlineCss':
                case 'inlineStyle':
                    $tag = 'style'; 
                break;
                case 'inlineJs': 
                case 'inlineJavascript':
                    $tag = 'script';
                break;
            }

            array_unshift($output, '<'.$tag .'>');
            array_push($output, '</'.$tag.'>');
        }
        else
        {
            $assets = self::get($type);
            if( is_array($assets) && count($assets) )
            {
                foreach($assets as $id => $asset)
                {
                    self::createLink($output, $type, $id, $assets);
                }
            }
        }

        return $output; 

    }

    private static function createLink(&$result, $type, $id, &$assets)
    {
        if(!isset($assets[$id]))
        {
            $result[] = '<!-- '.$type. ' '. $id.' not found -->';
        }
        else
        {
            $asset = $assets[$id];

            if( !$assets[$id]->get('added', 0) )
            {
                if( count($asset->get('parents') ) )
                {
                    foreach($asset->get('parents') as $pid)
                    {
                        self::createLink($result, $type, $pid, $assets);
                    }
                }
    
                switch($type)
                {
                    case 'css':
                        $result[] = '<link rel="stylesheet" type="text/css" href="'.$asset->get('url').'" >';
                    break;
                    case 'js':
                        $result[] = '<script src="'.$asset->get('url').'" ></script>';
                    break;
                }
    
                $assets[$id]->set('added', 1); 
            }
        }
    }

    public static function init($theme)
    {
        if( self::$_theme === '')
        {
            define('THEME_PATH', APP_PATH. 'themes/'. $theme. '/');
            self::$_theme = $theme;
        }
    }

    public static function createPage()
    {
        if(!defined('THEME_PATH')) die('<!-- Invalid theme -->');
        
        include THEME_PATH. self::$_theme. '.php';

        /**
         *  TODO: use structure fefine as default.html to generate a page
         *  $tags = [ 'content', 'css', 'js', 'widget' ]
         */
    }

    public static function echoWidget($name, $data = array())
    {
        if(!defined('THEME_PATH')) die('<!-- Invalid theme -->');

        $layout = THEME_PATH.'widgets/'. $name. '/'. $name. '.php';

        if(!file_exists($layout))
        {
            $layout = APP_PATH. 'widgets/'. $name. '/'. $name. '.php';
            
        }

        if(file_exists($layout))
        {
            ob_start();
            include $layout;
            echo  ob_get_clean();
        }
    }

}
