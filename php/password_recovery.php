<?php
$error = [
  'email' => false,
  'password' => false,
  'check_pass' => false
];

$pass_regex = '/^(?=.*[0-9])(?=.*[\W_]).{8,}$/';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
  include '../backend/db_functions.php';

  $email = $_POST['email'];
  $newpass = $_POST['password'];
  $checkpass = $_POST['check_pass'];

  // Validate email existence
  $query = "SELECT * FROM user WHERE user_email = ?";
  $stmt = mysqli_prepare($db_connect, $query);
  $email = trim($email);
  mysqli_stmt_bind_param($stmt, 's', $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) == 0) {
    $error['email'] = true;
  } else {
    // Validate password match
    if ($newpass != $checkpass) {
      $error['check_pass'] = true;
    } else {
      //REGEX validation
      if (preg_match($pass_regex, $newpass)) {
        // Update password
        $hashed_pass = crypt($newpass, PASSWORD_DEFAULT);
        $update_query = "UPDATE user SET user_password = ? WHERE user_email = ?";
        $update_stmt = mysqli_prepare($db_connect, $update_query);
        mysqli_stmt_bind_param($update_stmt, 'ss', $hashed_pass, $email);

        if (!mysqli_stmt_execute($update_stmt)) {
          $error['password'] = true;
        }
      } else {
        $error['password'] = true;
      }
    }
  }

  mysqli_close($db_connect);

  // Redirect if no errors
  if (!in_array(true, $error)) {
    header('Location: ../php/login.php');
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Recovery</title>
  <link rel="stylesheet" href="../styles/general.css">
  <link rel="stylesheet" href="../styles/login_reg.css">
</head>

<body>
  <div>
    <section class="login forms">
      <div class="row_fields">
        <h1>Password Recovery</h1>
      </div>
      <form method="post">
        <div class="row_fields">
          <label for="email">Email</label>
          <input type="text" name="email" class="text <?php if ($error['email']) echo "err_field" ?>" value="<?php echo @$_POST['email'] ?>" required>
          <?php if ($error['email']) echo '<span class="err_message">Invalid email</span>'; ?>
        </div>
        <div class="row_fields">
          <label for="password" class="">Password</label>
          <input type="password" name="password" class="text <?php if ($error['password']) echo "err_field" ?>" value="<?php echo @$_POST['password'] ?>" required>
          <?php if ($error['password']) echo '<span class="err_message">Invalid Password</span>'; ?>
        </div>
        <div class="row_fields">
          <label for="check_pass">Confirm password</label>
          <input type="password" name="check_pass" class="text <?php if ($error['check_pass']) echo "err_field" ?>" value="<?php echo @$_POST['check_pass'] ?>" required>
          <?php if ($error['check_pass']) echo '<span class="err_message">Password does not match</span>'; ?>
        </div>
        <div>
          <input type="submit" name="confirm" value="Confirm" class="btn">
        </div>
      </form>
    </section>
  </div>
</body>

</html>