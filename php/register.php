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
      header('Location: ../php/login.php'); // redirect to login page

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
  <title>SoloSpend Register</title>
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
            <input type="text" name="fname" id="fname" class="<?php if (@$error['fname']) echo "err_field" ?>" value="<?php echo @$_POST['fname'] ?>" required>
            <?php if (@$error['fname']) echo '<span class="err_message">Invalid First Name</span>'; ?>
          </div>

          <div class="row_fields">
            <label for="mname">Middle Name:</label>
            <input type="text" name="mname" id="mname" class="<?php if (@$error['mname']) echo "err_field" ?>" value="<?php echo @$_POST['mname'] ?>">
            <?php if (@$error['mname']) echo '<span class="err_message">Invalid Middle Name</span>'; ?>
          </div>

          <div class="row_fields">
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname" class="<?php if (@$error['lname']) echo "err_field" ?>" value="<?php echo @$_POST['lname'] ?>" required>
            <?php if (@$error['lname']) echo '<span class="err_message">Invalid Last Name</span>'; ?>
          </div>
        </div>
        <div class="row_field_row">
          <div class="row_fields">
            <label for="uname">Username:</label>
            <input type="text" name="uname" id="uname" class="<?php if (@$error['uname']) echo "err_field" ?>" value="<?php echo @$_POST['uname'] ?>" required>
            <?php if (@$error['uname']) echo '<span class="err_message">Invalid Username</span>'; ?>
          </div>

          <div class="row_fields">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" class="<?php if (@$error['email']) echo "err_field" ?>" value="<?php echo @$_POST['email'] ?>" required>
            <?php if (@$error['email']) echo '<span class="err_message">Invalid Email</span>'; ?>
          </div>

          <div class="row_fields">
            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" class="<?php if (@$error['email']) echo "err_field" ?>">
            <?php if (@$error['dob']) echo '<span class="err_message">Invalid Date of Birth</span>'; ?>
          </div>
        </div>

        <div class="row_field_row">
          <div class="row_fields">
            <label for="pass">Password:</label>
            <input type="password" name="password" id="pass" class="<?php if (@$error['password']) echo "err_field" ?>" value="<?php echo @$_POST['password'] ?>" required>
            <?php if (@$error['password']) echo '<span class="err_message">Invalid Password</span>'; ?>
          </div>

          <div class="row_fields">
            <label for="check_pass">Confirm Password:</label>
            <input type="password" name="check_password" id="check_pass" class="<?php if (@$error['check_password']) echo "err_field" ?>" value="<?php echo @$_POST['check_password'] ?>" required>
            <?php if (@$error['dob']) echo '<span class="err_message">Password does not match.</span>'; ?>
          </div>
        </div>

        <div class="row_fields checkbox">
          <input type="checkbox" name="agree" id="agree" required>
          <label for="agree">Agree with <a href="../php/terms.php">Terms and Services</a> and <a href="../php/privacy.php">Privacy Policy</a></label>
        </div>

        <div class="row_fields">
          <label>Already have and account? <a href="../php/login.php">Login.</a></label>
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