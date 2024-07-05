<?php 
/*
  This PHP file contains the variables and functions that will be used for registration and login validation
*/

// REGEX Patterns
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

function validate_login($input_uname, $input_password, &$error) {
  /*
  Function to validate login credentials
  */
  global $pattern;

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

  // Reset error array
  $error = [
    'uname' => false,
    'password' => false
  ];

  // Validate username pattern
  if (!preg_match($pattern['uname'], $input_uname)) {
    $error['uname'] = true;
  }

  // Validate password pattern
  if (!preg_match($pattern['password'], $input_password)) {
    $error['password'] = true;
  }

  // Check if username or email exists in the database
  $query = "SELECT * FROM user WHERE user_uname = ?";
  $stmt = mysqli_prepare($db_connect, $query);
  mysqli_stmt_bind_param($stmt, 's', $input_uname);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) == 0) {
    $error['uname'] = true;
    mysqli_close($db_connect);
  } else {
    $row = mysqli_fetch_assoc($result);
    print_r($row);
    $db_password = $row['user_password'];
    if (password_verify($input_password, $db_password)) { 
      mysqli_close($db_connect);
      return true;
    } else {
      $error['password'] = true;
      mysqli_close($db_connect);
    }
  }
}


?>
