<?php
  $host = 'db';
  $user = 'root';
  $password = 'password';
  $database = 'testImg';

  // Create a new mysqli object
  $mysqli = new mysqli($host, $user, $password, $database);

  // Check if the connection was successful
  if ($mysqli->connect_error) {
      die('Error connecting to the database: ' . $mysqli->connect_error);
  }

  // If needed, just uncomment to check if the connection is success or not
  // echo 'DB Connect Success';

  header("Access-Control-Allow-Origin: *"); // Allow requests from any origin
  header("Access-Control-Allow-Methods: POST"); // Allow only POST requests
  header("Access-Control-Allow-Headers: Content-Type"); // Allow only Content-Type header

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the image data from the request body
    $data = json_decode(file_get_contents('php://input'), true);
    $imageData = $data['image'];

    // Decode the base64-encoded image data
    $img = base64_decode(str_replace('data:image/png;base64,', '', $imageData));

    if(isset($imageData)) {
      $sql = "INSERT INTO `images`(`img`) VALUES ('".$imageData."');";
      
      $result = mysqli_query($mysqli, $sql);

      // echo json_encode($sql);
      echo json_encode("image saved");
      exit;
    }

    echo json_encode("not saved");
  }
?>