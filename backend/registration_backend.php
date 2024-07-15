<?php
/*
  This php file contains the variables and functions that will be used for registration
*/

//REGEX patterns
$pattern = [
  'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
  'fname' => '/^(?!\d)[a-zA-Z\s]*$/', // Must not start with a digit, allows letters and spaces
  'mname' => '/^(?!\d)[a-zA-Z\s]*$/', // Must not start with a digit, allows letters and spaces
  'lname' => '/^(?!\d)[a-zA-Z\s]*$/', // Must not start with a digit, allows letters and spaces
  'password' => '/^(?=.*[0-9])(?=.*[\W_]).{8,}$/', // At least 1 number, 1 special character, and at least 8 characters
  'uname' => '/^[a-zA-Z0-9]{1,30}$/', // At most 30 characters long, contains no spaces, and no special characters
];

//Error boolean variables
$error = [
  'email' => false,
  'uname' => false,
  'fname' => false,
  'mname' => false,
  'lname' => false,
  'password' => false,
  'dob' => false,
  'check_password' => false
];

function validate_reg_info($reg_info, $pattern, &$error)
{
  //Validate user input with REGEX
  foreach ($reg_info as $key => $value) {
    if (isset($pattern[$key])) {
      if (!preg_match($pattern[$key], $value)) {
        $error[$key] = true;
      }
    }
  }

  //Validate dob to between 1950 to current year
  if (!validate_dob($reg_info['dob'])) {
    $error['dob'] = true;
  }

  //Validate if the password matched the confirmation
  if ($reg_info['password'] != $reg_info['check_password']) {
    $error['check_password'] = true;
  }
}



function database_insert($reg_info, &$error)
{
  /*
    Function to insert registration information to the database.
  */

  $database = [
    'name' => 'solospend_db',
    'host' => 'localhost',
    'pass' => '',
    'user' => 'root'
  ];
  $db_connect = mysqli_connect($database['host'], $database['user'], $database['pass'], $database['name']);

  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

  $uname = strtolower(mysqli_real_escape_string($db_connect, $reg_info['uname']));
  $fname = mysqli_real_escape_string($db_connect, $reg_info['fname']);
  $lname = mysqli_real_escape_string($db_connect, $reg_info['lname']);
  $email = mysqli_real_escape_string($db_connect, $reg_info['email']);
  $password = mysqli_real_escape_string($db_connect, password_hash($reg_info['password'], PASSWORD_DEFAULT));
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

function database_email_check($reg_info, &$error)
{
  /*
    Function to check if the given email to register is already on the database.
  */

  $database = [
    'name' => 'solospend_db',
    'host' => 'localhost',
    'pass' => '',
    'user' => 'root'
  ];
  $db_connect = mysqli_connect($database['host'], $database['user'], $database['pass'], $database['name']);
  $email = mysqli_real_escape_string($db_connect, $reg_info['email']);
  $check_query = "SELECT * FROM user WHERE user_email = '$email'";
  $result = mysqli_query($db_connect, $check_query);

  if (mysqli_num_rows($result) > 0) {
    $error['email'] = true;
  }
  mysqli_close($db_connect);
}


function validate_dob($dob) {
  /*
    Validates the date of birth.
  */
  $dob_year = date('Y', strtotime($dob));
  $current_year = date('Y');

  return ($dob_year >= 1950 && $dob_year <= $current_year);
}
