<?php

include 'functions/dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userID = $_POST['userID'];

  $sql = "Delete from employee where id=".$userID;

  $result = mysqli_query($mysqli, $sql);

  header("Location: index.php");
}
  
?>