<?php
if (isset($_POST["login"]) && $_POST["register"] == "") {
  header('Location: login.php');
} elseif (isset($_POST["register"]) && $_POST["login"] == "") {
  header('Location: register.php');
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
  <div>
    <form method="post" target="_self">
      <div>
        <label for="login">Login</label> <br>
        <input type="submit" id="login" name="login" value="Login">
      </div>
      <br>
      <div>
        <label for="register">Register</label> <br>
        <input type="submit" id="register" name="register" value="Register">
      </div>
      <br>
    </form>

    <a href="php/dashboard.php">Dashboard</a>
  </div>
</body>

</html>