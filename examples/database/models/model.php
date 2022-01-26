<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace Examples\database\models;

defined( 'APP_PATH' ) or die('');

use SPT\BaseObj;

class model extends BaseObj 
{

    public function email( $to , $subject , $body, $from){

        ob_start();
        include APP_PATH.'/views/mail.'.$body.'.php';
        $message = ob_get_clean();

        $headers[] = 'MIME-Version: 1.0';
        if(config::get('mailSupportHTML', 0))
        {
            $headers[] = 'Content-type: text/html; charset=UTF-8';
        }

        if( $cc = config::get('mailCC', 0))
        {
            $headers[] = 'Cc: '.$cc;
        }

        if( $bcc = config::get('mailBCC', 0))
        {
            $headers[] = 'Bcc: '.$bcc;
        }
        //$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
        $headers[] = 'To: '. $to.' <'.$to.'>';
        $headers[] = 'From: '. config::get('mailFrom', 'Example SPT Software') .' <'. $from .'>';
        
        @mail ( $to , $subject , $message , implode("\r\n", $headers));
    }
    
}
