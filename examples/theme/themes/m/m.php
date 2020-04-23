<?php
/**
 * SPT software - Theme Materialize
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A way to display page in Materialize style
 * 
 */

defined( 'APP_PATH' ) or die('');

/**
 * Basic script:
 * 
 * <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
 * <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
 * 
 * 
 */

Theme::add('https://code.jquery.com/jquery-2.1.1.min.js', '', 'jquery');
Theme::add('https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css', '', 'materialize');
Theme::add('https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js', 'jquery', 'materialize');

$structure = application::get('structure', 'index');

include THEME_PATH. $structure.'.php';