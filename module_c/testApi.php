<?php  

  header("Access-Control-Allow-Origin: *");

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode("hi");
  }
?>  