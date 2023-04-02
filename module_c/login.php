<?php

  session_start();

  // Hold the value of input
  $username = '';
  $password = '';

  $usernameErr = '';
  $passwordErr = '';

  // handle form submission if it has been submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // trim input
    // - Password value should not be trimmed, the space might be the password
    // ---
    
    // trim username
    $username = trim($username);


    if (empty($username)) {
      $usernameErr = 'Username is required';
    }

    if (empty($password)) {
      $passwordErr = 'Password is required';
    }

    /**
     * TODO:
     * 1. 2 more validation error
     * 2. one for username, if it is not found
     * 3. one for password, if not match
     */

    
    // TODO > will replace this code. We will check with DB for the login credentials
    if ($username && $password) {
      $_SESSION['username'] = $username;
      header('Location: index.php');
      exit;
    }

  }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>

    <style>
      .error {
        color: red
      }
    </style>

    <script src="lib/jquery-3.3.1.slim.min.js"></script>
</head>
<body>

    <?php include('layout/nav.php') ?>

    <h1>Login</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>">
        <span class="error">* <?php echo $usernameErr;?></span><br><br>
        <label for="password">Password:</label>
        <!-- Password value should not be retain -->
        <input type="password" id="password" name="password">
        <span class="error">* <?php echo $passwordErr;?></span><br><br>
        <input type="submit" value="Login">
        <button id="resetButton">Reset</button>
    </form>

    <script>
      // focus on the username input field when the page is loaded
      $(document).ready(function() {
        $('#username').focus();

        $('#resetButton').on('click', function() {
          $('#username').val('');
          $('#password').val('');

          $('#username').focus();
        });
      });
    </script>
</body>
</html>
