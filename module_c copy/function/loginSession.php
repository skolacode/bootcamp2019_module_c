<?php

  session_start();

  // By default, we set the login to false
  $isLogin = false;

  // Set the login to true, if there is a session
  if(isset($_SESSION['username'])) {
    $isLogin = true;
  }
?>