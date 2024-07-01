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
              <Label>User Name:</Label>
              <input type="text" name="uname" class="text <?php if(@$error['uname']) echo "err_field"?>" value="<?php echo @$uname?>" required>
              <?php if (@$error['uname']) echo '<span class="err_message">Invalid Username</span>'; ?>
            </div>

            <div class="row_fields">
              <label for="password">Password:</label>
              <input type="password" name="password" class="text <?php if(@$error['password']) echo "err_field"?>" value="<?php echo @$password?>" required>
              <?php if (@$error['password']) echo '<span class="err_message">Invalid Password</span>'; ?>
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