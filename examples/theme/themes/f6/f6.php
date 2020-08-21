<?php
/**
 * SPT software - Theme f6 Foundation6
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A way to display page in foundation6 style
 * 
 */

defined( 'APP_PATH' ) or die('');

use SPT\Theme;
use Examples\theme\application;

/**
 * Basic script:
 * 
 * <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css" integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=" crossorigin="anonymous">
 * <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/js/foundation.min.js" integrity="sha256-pRF3zifJRA9jXGv++b06qwtSqX1byFQOLjqa2PTEb2o=" crossorigin="anonymous"></script>
 * 
 * 
 */

Theme::add('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', '', 'jquery');
Theme::add('https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css', '', 'foundation');
Theme::add('https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/js/foundation.min.js', 'jquery', 'foundation');

$page = application::get('page', 'index');

include THEME_PATH. $page.'.php';

/**
 *  TODO: use page fefine as default.html to generate a page
 */