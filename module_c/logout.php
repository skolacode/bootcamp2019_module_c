<?php

  // Must start the session
  session_start();

  // Unset all variable and destroy the session
  session_unset();
  session_destroy();


  // Redirect to proper page after logout success
  header('Location: index.php');
  exit;
?>