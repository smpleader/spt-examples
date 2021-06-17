<?php defined( 'APP_PATH' ) or die('');

use SPT\Theme;

Theme::addInline('js', 'console.log("hi")');

Theme::add('https://code.jquery.com/jquery-2.1.1.min.js', '', 'jquery');
Theme::add('https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css', '', 'materialize');
Theme::add('https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js', 'jquery', 'materialize');


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Demo Materialize</title>
    <?php Theme::echo('css') ?>
  </head>
  <body>
    <nav class="light-blue lighten-1" role="navigation">
      <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Logo</a>
        <ul class="right hide-on-med-and-down">
          <li><a href="#">Navbar Link</a></li>
        </ul>

        <ul id="nav-mobile" class="sidenav">
          <li><a href="#">Navbar Link</a></li>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      </div>
    </nav>
    <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <div class="row ">
        <div class="col m9 ">
          <?php echo $this->getBody(); ?>
        </div>
        <div class="col m3 center">
          <br><br>
          <?php  echo $this->createWidget('selectTheme', $this->session->get('theme')); ?>
          </div>
        </div>
      </div>
      

    </div>
  </div>
    <?php Theme::echo('js') ?>
    <?php Theme::echo('inlineJs') ?>
  </body>
</html>