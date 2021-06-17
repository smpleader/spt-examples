<?php defined( 'APP_PATH' ) or die('');

use SPT\Theme;

Theme::add('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', '', 'bootstrap');
Theme::add('https://code.jquery.com/jquery-3.2.1.slim.min.js', '', 'jquery-3.2.1.slim');
Theme::add('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', '', 'popper');
Theme::add('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', '', 'bootstrap');

Theme::addInline('js', 'console.log("Test addInline")');
Theme::addInline('css', '
.bd-navbar {
  min-height: 4rem;
  background-color: #563d7c;
  box-shadow: 0 0.5rem 1rem rgba(0,0,0,.05), inset 0 -1px 0 rgba(0,0,0,.1);
}
');


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Demo with Bootstrap4</title>
    <?php Theme::echo('css') ?>
    <?php Theme::echo('inlineCss') ?>
  </head>
  <body>
    <header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
      <a class="navbar-brand mr-0 mr-md-2" href="/" aria-label="Bootstrap"><svg class="d-block" width="36" height="36" viewBox="0 0 612 612" xmlns="http://www.w3.org/2000/svg" focusable="false"><title>Bootstrap</title><path fill="currentColor" d="M510 8a94.3 94.3 0 0 1 94 94v408a94.3 94.3 0 0 1-94 94H102a94.3 94.3 0 0 1-94-94V102a94.3 94.3 0 0 1 94-94h408m0-8H102C45.9 0 0 45.9 0 102v408c0 56.1 45.9 102 102 102h408c56.1 0 102-45.9 102-102V102C612 45.9 566.1 0 510 0z"></path><path fill="currentColor" d="M196.77 471.5V154.43h124.15c54.27 0 91 31.64 91 79.1 0 33-24.17 63.72-54.71 69.21v1.76c43.07 5.49 70.75 35.82 70.75 78 0 55.81-40 89-107.45 89zm39.55-180.4h63.28c46.8 0 72.29-18.68 72.29-53 0-31.42-21.53-48.78-60-48.78h-75.57zm78.22 145.46c47.68 0 72.73-19.34 72.73-56s-25.93-55.37-76.46-55.37h-74.49v111.4z"></path></svg></a>
      <div class="navbar-nav-scroll">
        <ul class="navbar-nav bd-navbar-nav flex-row">
          <li class="nav-item">
            <a class="nav-link " href="/" >Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#" >One</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="#" >Two</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" >Three</a>
          </li>
        </ul>
      </div>
    </header>
    <div class="container mt-3">
      <div class="row">
        <div class="col-9">
            <?php echo $this->getBody(); ?>
        </div>
        <div class="col-3">
          <?php  echo $this->createWidget('selectTheme', $this->session->get('theme')); ?>
        </div>
      </div>
    </div>
    <?php Theme::echo('js') ?>
    <?php Theme::echo('inlineJs') ?>
  </body>
</html>