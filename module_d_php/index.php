<?php

  header("Access-Control-Allow-Origin: *"); // Allow requests from any origin

  $data = array(
    'name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'age' => 30,
    'is_active' => true
  );
  
  echo json_encode($data);
?>