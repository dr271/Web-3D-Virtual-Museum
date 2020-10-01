<!-- The main landing page - from index.php -->

<?php
  // Import the appropriate classes as per the MVC structure 
  require 'view/load.php';
  require 'model/model.php';
  require 'controller/controller.php';

  // Initialise the Controller class to facilitate navigation.
  $controller = new Controller();

  if (isset($_GET['page']) == false) {
    // Navigate to home if no page specified.
    $controller->render('home');
  } else {
    // If a page was specified, extract it.
    $controller->render($_GET['page']);
  }
?>
