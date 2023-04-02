<?php
  // PHP code goes here
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>

    <script src="lib/jquery-3.3.1.slim.min.js"></script>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
        <input type="reset" value="Reset">
    </form>

    <script>
      // focus on the username input field when the page is loaded
      $(document).ready(function() {
          $('#username').focus();
      });

      // focus on the username input field after the reset button is clicked
      $('input[type="reset"]').on('click', function() {
            $('#username').focus();
        });
    </script>
</body>
</html>
