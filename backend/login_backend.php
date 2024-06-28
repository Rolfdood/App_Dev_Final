<?php 
/*
  This PHP file contains the variables and functions that will be used for registration and login validation
*/

// Regular expressions for validation
$pattern = [
  'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
  'password' => '/^(?=.*[0-9])(?=.*[\W_]).{8,}$/', // At least 1 number, 1 special character, and at least 8 characters
  'uname' => '/^[a-zA-Z0-9]{1,30}$/', // At most 30 characters long, contains no spaces, and no special characters
];

$error = [
  'email' => false,
  'uname' => false,
  'password' => false
];

// Function to validate the username and password
function validate_login($input_uname, $input_password){
  global $error, $pattern;

  $database = [
    'name' => 'fintrack_db',
    'host' => 'localhost',
    'pass' => '',
    'user' => 'root'
  ];

  $db_connect = mysqli_connect($database['host'], $database['user'], $database['pass'], $database['name']);

  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

  try {
    // Validate username pattern
    if (!preg_match($pattern['uname'], $input_uname)) {
      $error['uname'] = true;
      echo "Invalid username format.";
      return false;
    }

    // Validate password pattern
    if (!preg_match($pattern['password'], $input_password)) {
      $error['password'] = true;
      echo "Invalid password format.";
      return false;
    }

    // Check if username or email exists in the database
    $query = "SELECT * FROM user WHERE user_uname = ? OR user_email = ?";
    $stmt = mysqli_prepare($db_connect, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $input_uname, $input_uname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
      echo "Username or email does not exist.";
      return false;
    } else {
      $row = mysqli_fetch_assoc($result);
      // Verify password hashed in the database
      if (password_verify($input_password, $row['password'])) {
        echo "Login successful.";
        return true;
      } else {
        echo "Incorrect password.";
        return false;
      }
    }
  } finally {
    mysqli_close($db_connect);
  }
}
?>
