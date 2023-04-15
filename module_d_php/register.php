<?php

  include 'functions/dbConnection.php';

  header("Access-Control-Allow-Origin: *"); // Allow requests from any origin
  header("Access-Control-Allow-Methods: POST"); // Allow only POST requests
  header("Access-Control-Allow-Headers: Content-Type"); // Allow only Content-Type header

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $password = $data['password'];
    
    if($username && $password) {
      $password = crypt($password, "PASSWORD_DEFAULT");

      $sql = "INSERT INTO user (`username`, `hash`) values ('".$username."', '".$password."')";
      
      $result = mysqli_query($mysqli, $sql);
      
      echo json_encode("success");
      exit;
    }

    echo json_encode("failed");
  }
?>