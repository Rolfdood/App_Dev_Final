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
];

function validate_reg_info($reg_info, $pattern, &$error)
{
  foreach ($reg_info as $key => $value) {
    if (isset($pattern[$key])) {
      if (!preg_match($pattern[$key], $value)) {
        $error[$key] = true;
        //echo "Error in ".$pattern[$key];
      }
    }
  }
}

