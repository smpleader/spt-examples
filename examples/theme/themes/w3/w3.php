<?php
/**
 * SPT software - Theme w3 W3.css
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A way to display page in w3.css style
 * 
 */

defined( 'APP_PATH' ) or die('');

use SPT\Theme;
use Examples\theme\application;

/**
 * Basic script:
 * 
 * <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 * 
 * 
 */

Theme::add('https://www.w3schools.com/w3css/4/w3.css', '', 'w3');
Theme::add('https://code.jquery.com/jquery-2.1.1.min.js', '', 'jquery');

$page = application::get('page', 'index');

include THEME_PATH. $page.'.php';