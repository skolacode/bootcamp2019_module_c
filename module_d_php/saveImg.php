<?php
  include 'functions/dbConnection.php';

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
      $sql = "INSERT INTO 
        `drawing`(`username`,`title`, `status`, `image`) 
        VALUES (
          'admin1',
          'test title',
          'Public',
          '".$imageData."'
        );";
      
      $result = mysqli_query($mysqli, $sql);

      // echo json_encode($sql);
      echo json_encode("image saved");
      exit;
    }

    echo json_encode("not saved");
  }
?>