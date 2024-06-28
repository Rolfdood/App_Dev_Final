<?php
  include("../backend/login_backend.php");
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
      
      validate_login($_POST['uname'],$_POST['password']);
      if (!in_array(true, $error)) {
        header('Location: ../dashboard.php'); // redirect to home page
        exit();
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
        <Label>User Name</Label>
        <input type="text" name="uname" class="<?php if(@$error['uname']) echo "error"?>" value="<?php echo @$uname?>" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" class="<?php if(@$error['password']) echo "error"?>" value="<?php echo @$password?>" required>
        <br>
        <label for="remember_me">Remember Me</label>
        <input type="checkbox" name="remember_me" class="" required>
        <br>
        <input type="submit" value="Login" name="login" required> 
    </form>
  </div>
</body>
</html>