<?php
/**
 * SPT software - Theme b4 Bootstrap 4
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A way to display page in bootstrap4 style
 * 
 */

defined( 'APP_PATH' ) or die('');

use SPT\Theme;
use Examples\theme\application;

/**
 * Basic script:
 * 
 * <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 * <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 * <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 * <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 * 
 */

Theme::add('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', '', 'bootstrap');
Theme::add('https://code.jquery.com/jquery-3.2.1.slim.min.js', '', 'jquery-3.2.1.slim');
Theme::add('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', '', 'popper');
Theme::add('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', '', 'bootstrap');

$page = application::get('page', 'index');

include THEME_PATH. $page.'.php';