<?php
  if(isset($_POST["login"]) && $_POST["register"] == "") {
    // go to login page
  } elseif(isset($_POST["register"]) && $_POST["login"] == ""){
    // go to register page
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FinTrack</title>
</head>
<body>
  <form method="post" target="_self">
    <label for="login">Login</label> <br>
    <input type="submit" name="login" value="Login"> <br>
    <label for="register">Register</label> <br>
    <input type="submit" name="register" value="Register"> <br>
  </form>
</body>
</html>