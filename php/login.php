<?php
  session_start();
  include("../backend/login_backend.php");
  
  $error = ['uname' => false, 'password' => false];
  $errorMsg = '';
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['login'])) {
          $loginSuccessful = validate_login($_POST['uname'], $_POST['password'], $error);
          
          if ($loginSuccessful) {
              // Set session variables or other actions for successful login
              $_SESSION['username'] = $_POST['uname'];
              header('Location: dashboard.php'); // redirect to home page
              exit();
          } else {
              // Error message based on the $error array
              if ($error['uname']) {
                  $errorMsg = "Invalid username or username does not exist.";
              } elseif ($error['password']) {
                  $errorMsg = "Invalid or incorrect password.";
              } else {
                  $errorMsg = "Unknown error occurred.";
              }
          }
      }
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FinTrack Login</title>
  <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
  <div>
  <h1>Login</h1>
  </div>
  <div class="box">
    <form method="post">
        <Label>User Name or Email</Label>
        <br>
        <input type="text" name="uname" class="<?php if(@$error['uname']) echo "error"?>" value="<?php echo @$uname?>" required>
        <br>
        <label for="password">Password</label>
        <br>
        <input type="password" name="password" class="<?php if(@$error['password']) echo "error"?>" value="<?php echo @$password?>" required>
        <br>
        <label for="remember_me">Remember Me</label>
        <input type="checkbox" name="remember_me" class="">
        <br>
        <input type="submit" value="Login" name="login" required> 
    </form>
  </div>
</body>
</html>