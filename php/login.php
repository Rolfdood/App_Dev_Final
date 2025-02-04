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
              $_SESSION['user_id'] = get_UID($_POST['uname']);
              header('Location: dashboard.php');
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
    <link rel="icon" href="../src/assets/logo_colored.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>SoloSpend Login</title>
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/login_reg.css">
    <link rel="stylesheet" href="../styles/navbar.css">

  </head>

  <body>
  <nav class="navbar">
      <div class="logo">
        <img src="../src/assets/logo_colored.png" alt="logo">
        <span class="app-name">SoloSpend</span>
      </div>

      <div class="nav-buttons">
        <ul>
          <li class="nav-link">
            <a href="../index.php">
              <i class='bx bxs-home icon'></i>
              <span class="text2">HOME</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <section class="details1">
        <div class="deets">
          <span class="quote">Beware of little expenses; a small leak will sink a great ship.</span>
          <span class="author">Benjamin Franklin</span>
        </div>
      </section>

      <section class="login forms">
        <h1>LOGIN</h1>
        <hr>
        <form method="post">
            <div class="row_fields">
              <Label>User Name:</Label>
              <input type="text" name="uname" class="text <?php if(@$error['uname']) echo "err_field"?>" value="<?php echo @$_POST['uname'] ?>" required>
              <?php if (@$error['uname']) echo '<span class="err_message">Invalid Username</span>'; ?>
            </div>

            <div class="row_fields">
              <label for="password">Password:</label>
              <input type="password" name="password" class="text <?php if(@$error['password']) echo "err_field"?>" value="<?php echo @$_POST['password'] ?>" required>
              <?php if (@$error['password']) echo '<span class="err_message">Invalid Password</span>'; ?>
            </div>
        
            <div class="row_remember_me">
              <input type="checkbox" name="remember_me" class="">
              <label for="remember_me">Remember Me</label>
            </div>

            <input type="submit" class="btn" value="LOGIN" name="login" required> 

            <div class="row_remember_me">
              <a href="../php/password_recovery.php">Forgot your password?</a>
            </div>

            <div class="row_remember_me">
              <label>Don't have and account? <a href="../php/register.php">Register.</a></label>
            </div>
        </form> 
      </section>
    </div>
  </body>
</html>