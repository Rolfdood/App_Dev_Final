<?php
//This php file contains the variables and functions that will be used for registration
$pattern = [
  'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
  'fname' => '/^(?!\d)[a-zA-Z\s]*$/', // Must not start with a digit, allows letters and spaces
  'mname' => '/^(?!\d)[a-zA-Z\s]*$/', // Must not start with a digit, allows letters and spaces
  'lname' => '/^(?!\d)[a-zA-Z\s]*$/', // Must not start with a digit, allows letters and spaces
  'password' => '/^(?=.*[0-9])(?=.*[\W_]).{8,}$/', // At least 1 number, 1 special character, and at least 8 characters
  'uname' => '/^[a-zA-Z0-9]{1,30}$/', // At most 30 characters long, contains no spaces, and no special characters
];

$error = [
  'email' => false,
  'uname' => false,
  'fname' => false,
  'mname' => false,
  'lname' => false,
  'password' => false,
  'dob' => false,
  'check_password' => false,
];

function validate_reg_info($reg_info, $pattern, &$error)
{
  foreach ($reg_info as $key => $value) {
    if (isset($pattern[$key])) {
      if (!preg_match($pattern[$key], $value)) {
        $error[$key] = true;
        echo "Error in " . $pattern[$key];
      }
    }
  }
  //Insert date of birth validation
  if ($reg_info['password'] != $reg_info['check_password']) {
    $error['check_password'] = true;
  }
}


function database_insert($reg_info, &$error)
{
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

  $uname = mysqli_real_escape_string($db_connect, $reg_info['uname']);
  $fname = mysqli_real_escape_string($db_connect, $reg_info['fname']);
  $lname = mysqli_real_escape_string($db_connect, $reg_info['lname']);
  $email = mysqli_real_escape_string($db_connect, $reg_info['email']);
  $password = mysqli_real_escape_string($db_connect, $reg_info['password']);
  $dob = mysqli_real_escape_string($db_connect, $reg_info['dob']);

  // Check if email already exists
  $sql = "INSERT INTO user (user_uname, user_fname, user_lname, user_email, user_password, user_dob)
            VALUES ('$uname','$fname', '$lname', '$email', '$password', '$dob')";

  if (mysqli_query($db_connect, $sql)) {
    echo "Registration successful";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db_connect);
  }
  mysqli_close($db_connect);
}

function database_email_check($reg_info, $error)
{
  $database = [
    'name' => 'fintrack_db',
    'host' => 'localhost',
    'pass' => '',
    'user' => 'root'
  ];
  $db_connect = mysqli_connect($database['host'], $database['user'], $database['pass'], $database['name']);
  $email = mysqli_real_escape_string($db_connect, $reg_info['email']);
  $check_query = "SELECT * FROM user WHERE user_email = '$email'";
  $result = mysqli_query($db_connect, $check_query);

  if (mysqli_num_rows($result) > 0) {
    // Error if email exists in database
    $error['email'] = true;
  }
  mysqli_close($db_connect);
}

function encrypt_password($password)
{
  // Create a random salt
  $salt = bin2hex(random_bytes(16));

  // Hash the password with the salt
  $hash = hash('sha256', $salt . $password);

  // Return the salt and hash combined
  return $salt . $hash;
}

function verify_password($password, $encrypted_password)
{
  // Step 1: Extract the salt from the stored password (first 32 characters for a 128-bit salt)
  $salt = substr($encrypted_password, 0, 32);

  // Step 2: Extract the stored hash (remaining characters)
  $stored_hash = substr($encrypted_password, 32);

  // Step 3: Concatenate the extracted salt with the input password and hash it
  $hash = hash('sha256', $salt . $password);

  // Step 4: Compare the newly generated hash with the stored hash
  return $hash === $stored_hash;
}
