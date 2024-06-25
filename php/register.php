<?php
  include("backend/registration_backend.php");
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
      $reg_info = []; // Submitted information is passed to this variable
      foreach ($_POST as $key => $value) {
        if ($key !== 'register') {
          $reg_info[$key] = $value;
        }
      }
      validate_reg_info($reg_info, $pattern, $error);

      //database validation function if there is duplicates not added
      if (!in_array(true, $error)) {
        $_SESSION['registered_data'] = $_POST;
        //add database insert SQL
        header('Location: index.php'); // redirect to home page
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
  <link rel="stylesheet" href="stylesheets/register.css">
</head>

<body>
  <div>
    <div>
      <h1>Register</h1>
    </div>
    <div class="box">
      <form method="post" target="_self">
        <div>
          <label for="uname">Username</label>
          <input type="text" name="uname" id="uname" class="<?php if(@$error['uname']) echo "error"?>" value="<?php echo @$uname?>" required>
          <br>
        </div>
        <div>
          <label for="fname">First Name</label>
          <input type="text" name="fname" id="fname" class="<?php if(@$error['fname']) echo "error"?>" value="<?php echo @$fname?>" required>
          <br>
        </div>
        <div>
          <label for="mname">Middle Name</label>
          <input type="text" name="mname" id="mname" class="<?php if(@$error['mname']) echo "error"?>" value="<?php echo @$mname?>">
          <br>
        </div>
        <div>
          <label for="lname">Last Name</label>
          <input type="text" name="lname" id="lname" class="<?php if(@$error['lname']) echo "error"?>" value="<?php echo @$lname?>" required>
          <br>
        </div>
        <div>
          <label for="email">Email</label>
          <input type="text" name="email" id="email" class="<?php if(@$error['email']) echo "error"?>" value="<?php echo @$email?>" required>
        </div>
        <div>
          <label for="pass">Password</label>
          <input type="password" name="password" id="pass" class="<?php if(@$error['password']) echo "error"?>" value="<?php echo @$password?>" required>
        </div>
        <div>
          <label for="dob">Date of Birth</label>
          <input type="date" name="dob" id="dob">
        </div>
        <div>
          <input type="submit" id="register" name="register" value="Register">
        </div>
      </form>
    </div>
  </div>
</body>

</html>
