<?php
/**
 * SPT software - Router
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A way to route the site based URL
 * 
 */

defined( 'SPT_PATH' ) or die('');

require_once 'config.php';

class Router extends staticObj
{
    static protected $_vars = array();

    /**
     * singleton
     */
    private static $instance;
    public static function _( $sitemap = [] ){

        if( self::$instance === null ){
            self::$instance = new Router();
            self::set('sitemap', array());
            self::$instance->parse();
        }

        if( is_array($sitemap) && count($sitemap) ) {
            foreach($sitemap as $key=>$value){
                if($key == '/' || empty($key))
                {
                    self::set('home', $value);
                    unset($sitemap[$key]);
                }
            }
            $arr = self::get('sitemap');
            $arr = array_merge($arr, $sitemap);
            self::set('sitemap', $arr);
        }

        return self::$instance;
    }
 
    public static function url($asset = ''){
        return self::get('root'). $asset;
    }

    /**
     * TODO support standardized CMS
     */
    private $nodes;
    private $sefUrls;
    //public function __construct(){}

    public function parse()
    {

        $protocol =  Config::get('siteProtocol', '');
        $p =  (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';

        if( empty($protocol) )
        {
            $protocol = $p;
        
        } else{
            
            // force protocol
            if($protocol != $p){
                header('Location: '.$protocol. '://'. $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI']);
                exit();
            }
        }

        $protocol .= '://';

        $current = $protocol. $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
        self::set('current', $current);

        $more = parse_url( $current );
        foreach( $more as $key => $value)
        {
            self::set( $key, $value);
        }

        $subPath = trim( Config::get('siteSubpath', ''), '/');

        $actualPath = '/'; 
        
        $actualPath = empty($subPath) ? $more['path'] : substr($more['path'], strlen($subPath)+1);
        
        $subPath = empty($subPath) ? '/' : '/'. $subPath .'/';

        self::set( 'root', $protocol. $_SERVER['HTTP_HOST']. $subPath );

        self::set( 'actualPath', $actualPath);

        self::set( 'isHome', ($actualPath == '/' || empty($actualPath)) );

        return;
    }

    public function pathFinding( $default, $callback = null)
    {
        $sitemap = self::get('sitemap');
        $path = self::get('actualPath');
        $isHome = self::get('isHome');
        
        if($isHome){
            $found = self::get('home', '');
            return $found === '' ? $default : $found;
        }

        if( isset($sitemap[$path]) )
        {
            return $sitemap[$path];
        }
        
        $found = false;

        if( is_callable($callback)){
            $found = $callback($sitemap, $path);
        } else {
            foreach( $sitemap as $reg=>$value ){
                $reg = str_replace( '-', '\-', $reg) ;
                if (preg_match ('#'. $reg. '#i', $path, $matches))
                {
                    if( !is_array($value) || isset($value['fnc']))
                    {
                        $found = $value;
                        break;
                    }
                }
            }
        }

        return ( $found === false ) ? $default : $found;

    }
}
