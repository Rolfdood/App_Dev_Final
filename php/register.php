<?php
  include("../backend/registration_backend.php");
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
      $reg_info = []; // Submitted information is passed to this variable
      foreach ($_POST as $key => $value) {
        if ($key !== 'register') {
          $reg_info[$key] = $value;
        }
      }
      validate_reg_info($reg_info, $pattern, $error);

      database_email_check($reg_info, $error);

      if (!in_array(true, $error)) {
        database_insert($reg_info, $error);
        header('Location: ../index.php'); // redirect to home page

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
    <title>FinTrack Register</title>
    <link rel="stylesheet" href="../styles/login_reg.css">
  </head>

  <body>
    <div class="container">
      <section class="reg-form forms">
        <h1>Register</h1>
        <hr>
        <form method="post" target="_self">
          <div class="row_field_row">
            <div class="row_fields">
              <label for="fname">First Name:</label>
              <input type="text" name="fname" id="fname" class="<?php if(@$error['fname']) echo "error"?>" value="<?php echo @$fname?>" required>
            </div>

            <div class="row_fields">
              <label for="mname">Middle Name:</label>
              <input type="text" name="mname" id="mname" class="<?php if(@$error['mname']) echo "error"?>" value="<?php echo @$mname?>">
            </div>
            
            <div class="row_fields">
              <label for="lname">Last Name:</label>
              <input type="text" name="lname" id="lname" class="<?php if(@$error['lname']) echo "error"?>" value="<?php echo @$lname?>" required>
            </div>
          </div>

          <div class="row_field_row">
            <div class="row_fields">
              <label for="uname">Username:</label>
              <input type="text" name="uname" id="uname" class="<?php if(@$error['uname']) echo "error"?>" value="<?php echo @$uname?>" required>
            </div>
            
            <div class="row_fields">
              <label for="email">Email:</label>
              <input type="text" name="email" id="email" class="<?php if(@$error['email']) echo "error"?>" value="<?php echo @$email?>" required>
            </div>

            <div class="row_fields">
              <label for="dob">Date of Birth:</label>
              <input type="date" name="dob" id="dob">
            </div>
          </div>

          <div class="row_field_row">
            <div class="row_fields">
              <label for="pass">Password:</label>
              <input type="password" name="password" id="pass" class="<?php if(@$error['password']) echo "error"?>" value="<?php echo @$password?>" required>
            </div>

            <div class="row_fields">
              <label for="check_pass">Confirm Password:</label>
              <input type="password" name="check_password" id="check_pass" class="<?php if(@$error['check_password']) echo "error"?>" required>
            </div>
          </div>

          <div class="row_field_row">
            <input type="submit" class="btn" id="register" name="register" value="REGISTER">
          </div>
        </form>
      </section>

      <section class="reg_deets">

      </section>
    </div>
  </body>
</html>
