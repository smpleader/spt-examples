<?php defined( 'APP_PATH' ) or die('');

use SPT\Theme;

Theme::addInline('js', 'console.log("hi")');

Theme::add('https://www.w3schools.com/w3css/4/w3.css', '', 'w3');
Theme::add('https://code.jquery.com/jquery-2.1.1.min.js', '', 'jquery');


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Demo W3.css</title>
    <?php Theme::echo('css') ?>
  </head>
  <body>
  <!-- Navbar (sit on top) -->
  <div class="w3-top">
    <div class="w3-bar w3-white w3-wide w3-padding w3-card">
      <a href="#home" class="w3-bar-item w3-button"><b>W3</b>.css</a>
      <!-- Float links to the right. Hide them on small screens -->
      <div class="w3-right w3-hide-small">
        <a href="#projects" class="w3-bar-item w3-button">One</a>
        <a href="#about" class="w3-bar-item w3-button">Two</a>
        <a href="#contact" class="w3-bar-item w3-button">Thre</a>
      </div>
    </div>
  </div>

  <!-- Header -->
  <header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
    <img class="w3-image" src="/w3images/architect.jpg" alt="Architecture" width="1500" height="800">
    <div class="w3-display-middle w3-margin-top w3-center">
      <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>BR</b></span> <span class="w3-hide-small w3-text-light-grey">Architects</span></h1>
    </div>
  </header>

  <!-- Page content -->
  <div class="w3-content w3-padding" style="max-width:1564px">
    <div class="w3-container w3-padding-32" id="projects">
      <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Info</h3>
    </div>
    <div class="w3-row-padding">
      <div class="w3-col l9 m6 w3-margin-bottom">
        <div class="w3-display-container">
          <?php echo $this->getBody(); ?>
        </div>
      </div>
      <div class="w3-col l3 m6 w3-margin-bottom">
        <div class="w3-display-container">
          <?php  echo $this->createWidget('selectTheme', $this->session->get('theme')); ?>
        </div>
      </div>
    </div> 
  </div>
    <?php Theme::echo('js') ?>
    <?php Theme::echo('inlineJs') ?>
  </body>
</html>