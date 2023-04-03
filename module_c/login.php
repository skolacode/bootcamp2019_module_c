<?php
  session_start();
  
  include 'functions/dbConnection.php';

  // Inputs
  $username = '';
  $pass = '';

  // Hold error values
  $usernameErr = '';
  $passErr = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $username = trim($username);
    // Password should not be trimmed
    $pass = trim($pass);

    if($username === '') {
      $usernameErr = 'Username is required';
    } 
    else {
      $usernameErr = '';
    }

    if($pass === '') {
      $passErr = 'Password is required';
    }
    else {
      $passErr = '';
    }

    // When both is not empty
    if($username && $pass) {
      $sql = "select * from admin where username = '".$username."' and password = '".$pass."'";

      $result = mysqli_query($mysqli, $sql);

      if (mysqli_num_rows($result) > 0) {
        
        // We set a session
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
      } else {
        $usernameErr = 'Username not match';
        $passErr = 'Password not match';
      }
    }
  }

  // If the user is login, redirect to index page
  if(isset($_SESSION['username'])) {
    header('Location: index.php');
  }

?>

<!DOCTYPE html>
<html lang="en">
  <?php include 'layout/header.php' ?>
<body>

  <?php include 'layout/navigation.php' ?>

  <h1>Login</h1>

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <!-- TO prevent cache value -->
    <input type="hidden" name="nonce" value="<?php echo uniqid(); ?>">

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" maxlength="20" value="<?= $username; ?>">
    <span class="error" id="usernameErr">* <?php echo $usernameErr;?></span>
    <br><br>
    
    <!-- Password value should not be retain -->
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" maxlength="20">
    <span class="error" id="passErr">* <?php echo $passErr;?></span>
    <br><br>
    
    <input type="submit" value="Login">
    <input type="reset" value="Reset" id="resetButton">
  </form>

  <script>
    // focus on the username input field when the page is loaded
    $(document).ready(function() {
      $('#username').focus();

      let passErr = $('#passErr').text();

      if(passErr !== '* ') {
        $('#password').focus();
      }

      $('#resetButton').on('click', () => {
        $('#username').attr('value', '');
        $('#password').attr('value', '');

        $('#username').focus();
      })
    });
  </script>
  
</body>
</html>