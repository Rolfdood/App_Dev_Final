<?php
  session_start();
  include("../backend/login_backend.php");
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
      
      validate_login($_POST['uname'],$_POST['password']);
      if (!in_array(true, $error)) {
        header('Location: dashboard.php'); // redirect to home page
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
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/login_reg.css">
  </head>

  <body>
    <div class="container">
      <section class="details">
      </section>

      <section class="login forms">
        <h1>LOGIN</h1>
        <hr>
        <form method="post">
            <div class="row_fields">
              <Label>User Name or Email:</Label>
              <input type="text" name="uname" class="text <?php if(@$erro['uname'] || @$error['email']) echo "error"?>" value="<?php echo @$uname?>" required>
            </div>

            <div class="row_fields">
              <label for="password">Password:</label>
              <input type="password" name="password" class="text <?php if(@$error['password']) echo "error"?>" value="<?php echo @$password?>" required>
            </div>
            
            <div class="row_remember_me">
              <input type="checkbox" name="remember_me" class="">
              <label for="remember_me">Remember Me</label>
            </div>
            <input type="submit" class="btn" value="LOGIN" name="login" required> 
        </form>
      </section>
    </div>
  </body>
</html>