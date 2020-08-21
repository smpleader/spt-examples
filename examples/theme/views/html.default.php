<?php
/**
 * SPT software - Layout html
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Display a layout
 * 
 */

use SPT\Lang;

echo '<h3>'. Lang::_('Default page'). '</h3>';
echo Lang::_('This is a simple HTMPL Page.') ;
echo '<a href="/examples/theme">'. Lang::_('Back home') .'</a>';