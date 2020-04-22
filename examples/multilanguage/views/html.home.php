<?php
/**
 * SPT software - Layout html
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Display a layout
 * 
 */

?>
<h1><?php Lang::e('Home page') ?></h1>
<p><?php Lang::e('Demo') ?>:</p>
<p></p>
<ul>
    <li>
        <a href="default-page?lang=en"><?php Lang::e('Default page') ?>: <?php Lang::e('in English') ?></a>
    </li>
    <li>
        <a href="default-page?lang=fr"><?php Lang::e('Default page') ?>: <?php Lang::e('in French') ?></a>
    </li>
    <li>
        <a href="?lang=en"><?php Lang::e('Home') ?>: <?php Lang::e('in English') ?></a>
    </li>
    <li>
        <a href="?lang=fr"><?php Lang::e('Home') ?>: <?php Lang::e('in French') ?></a>
    </li>
</ul>