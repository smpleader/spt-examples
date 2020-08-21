<?php defined( 'APP_PATH' ) or die('');

use SPT\Theme;
use Examples\theme\application;

Theme::addInline('js', 'console.log("hi")');

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Demo Foundation6</title>
    <?php Theme::echo('css') ?>
  </head>
  <body>
  <div class="top-bar">
      <div class="top-bar-left">
        <ul class="menu">
          <li class="menu-text">Foundation6</li>
          <li><a href="#">One</a></li>
          <li><a href="#">Two</a></li>
          <li><a href="#">Three</a></li>
        </ul>
      </div>
    </div>
    <div class="grid-x grid-padding-x">
      <div class="cell small-9"><?php echo application::get('body') ?></div>
      <div class="cell small-3">
        <br>
        <?php Theme::echoWidget('selectTheme', application::session('theme') ) ?>
      </div>
    </div>
    <?php Theme::echo('js') ?>
    <?php Theme::echo('inlineJs') ?>
  </body>
</html>