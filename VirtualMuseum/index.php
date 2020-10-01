<?php
  // Configure PHP to display all errors for debugging).
  error_reporting(E_ALL | E_STRICT);
  ini_set('display_errors', 1);

  // 'Load' in the main MVC app.
  require 'application/mvc_app.php';
?>
