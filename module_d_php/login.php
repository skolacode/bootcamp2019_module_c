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
      
      $sql = "select * from user where username = '".$username."' and hash = '".$password."'";
      
      $result = mysqli_query($mysqli, $sql);
      
      if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $lists[] = $row;
        }
        echo json_encode("success");
        exit;
      }
    }

    echo json_encode("failed");
  }
?>