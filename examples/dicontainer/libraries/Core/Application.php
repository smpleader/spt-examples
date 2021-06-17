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

defined( 'APP_PATH' ) or die('');

use SPT\Util;
use Joomla\DI\Container;
use Joomla\DI\ContainerAwareTrait;

class Application extends Base
{
    use BaseTrait;
    
    public function getCurrentLanguage()
    {
        $lange = Util::get('lang', 'en', 'get');
        
        if(!in_array($lange, $this->config->availableLanguages)){
            $lange = 'en';
        }

        return $lange;
    }

    public function redirect()
    {
        $redirect = $this->get('redirect', '/');
        $redirect_status = $this->get('redirectStatus', '302');

        if( headers_sent()){
            echo '<script>document.location.href="'.$redirect.'"</script>';
        }else{
            
            header( "Location: $redirect", true, $redirect_status );
        }
        exit(0);
    }
}