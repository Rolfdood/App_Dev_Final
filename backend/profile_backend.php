<?php
session_start();

// Regex patterns
$pattern = [
  'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
  'fname' => '/^(?!\d)[a-zA-Z\s]*$/', // Must not start with a digit, allows letters and spaces
  'lname' => '/^(?!\d)[a-zA-Z\s]*$/', // Must not start with a digit, allows letters and spaces
  'password' => '/^(?=.*[0-9])(?=.*[\W_]).{8,}$/', // At least 1 number, 1 special character, and at least 8 characters
  'uname' => '/^[a-zA-Z0-9]{1,30}$/', // At most 30 characters long, contains no spaces, and no special characters
];

// Error boolean variables
$error = [
  'email' => false,
  'uname' => false,
  'fname' => false,
  'lname' => false,
  'password' => false,
  'dob' => false,
  'check_password' => false
];

if (!isset($_SESSION['user_uname'])) {
  header('Location: ../backend/invalid_access.php');
  exit;
}

include '../backend/db_functions.php';

// Fetch user data from the database
$query = "SELECT * FROM user WHERE user_id = ?";
$stmt = mysqli_prepare($db_connect, $query);
$UID = $_SESSION['user_id'];
mysqli_stmt_bind_param($stmt, 's', $UID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$username = $row['user_uname'];
$fname = $row['user_fname'];
$lname = $row['user_lname'];
$email = $row['user_email'];
$dob = $row['user_dob'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // SAVE
  if (isset($_POST['save_uname'])) {
    if (preg_match($pattern['uname'], $_POST['username'])) {
      $_SESSION['user_uname'] = $_POST['username'];
      $username = $_POST['username'];
      /* $newquery = "UPDATE user SET user_uname = ? WHERE user_id = ?";
      $newstmt = mysqli_prepare($db_connect, $newquery);
      mysqli_stmt_bind_param($stmt, 'ss', $username ,$UID);
      mysqli_stmt_execute($stmt); */
    } else {
      $error['uname'] = true;
    }
    unset($_POST['edit_uname']);
  }
  if (isset($_POST['save_fname'])) {
    if (preg_match($pattern['fname'], $_POST['fname'])) {
      $_SESSION['user_fname'] = $_POST['fname'];
      $fname = $_POST['fname'];
    } else {
      $error['fname'] = true;
    }
    unset($_POST['edit_fname']);
  }
  if (isset($_POST['save_lname'])) {
    if (preg_match($pattern['lname'], $_POST['lname'])) {
      $_SESSION['user_lname'] = $_POST['lname'];
      $lname = $_POST['lname'];
    } else {
      $error['lname'] = true;
    }
    unset($_POST['edit_lname']);
  }
  if (isset($_POST['save_email'])) {
    if (preg_match($pattern['email'], $_POST['email'])) {
      $_SESSION['user_email'] = $_POST['email'];
      $email = $_POST['email'];
    } else {
      $error['email'] = true;
    }
    unset($_POST['edit_email']);
  }
  if (isset($_POST['save_dob'])) {
    $_SESSION['user_dob'] = $_POST['dob'];
    $dob = $_POST['dob'];
    unset($_POST['edit_dob']);
  }
  if (isset($_POST['save_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password && preg_match($pattern['password'], $new_password)) {
      $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
      $update_query = "UPDATE user SET user_password = ? WHERE user_id = ?";
      $update_stmt = mysqli_prepare($db_connect, $update_query);
      mysqli_stmt_bind_param($update_stmt, 'ss', $hashed_password, $UID);
      mysqli_stmt_execute($update_stmt);
    } else {
      $error['password'] = true;
    } 
    unset($_POST['edit_password']);
  }

  // EDIT
  if (isset($_POST['edit_uname'])) {
    $_SESSION['edit_uname'] = true;
  } elseif (isset($_POST['cancel_uname'])) {
    unset($_SESSION['edit_uname']);
  }
  if (isset($_POST['edit_fname'])) {
    $_SESSION['edit_fname'] = true;
  } elseif (isset($_POST['cancel_fname'])) {
    unset($_SESSION['edit_fname']);
  }
  if (isset($_POST['edit_lname'])) {
    $_SESSION['edit_lname'] = true;
  } elseif (isset($_POST['cancel_lname'])) {
    unset($_SESSION['edit_lname']);
  }
  if (isset($_POST['edit_email'])) {
    $_SESSION['edit_email'] = true;
  } elseif (isset($_POST['cancel_email'])) {
    unset($_SESSION['edit_email']);
  }
  if (isset($_POST['edit_dob'])) {
    $_SESSION['edit_dob'] = true;
  } elseif (isset($_POST['cancel_dob'])) {
    unset($_SESSION['edit_dob']);
  }
  if (isset($_POST['edit_password'])) {
    $_SESSION['edit_password'] = true;
  } elseif (isset($_POST['cancel_password'])) {
    unset($_SESSION['edit_password']);
  }
}

// Retrieve edit mode status from session
$edit_uname = isset($_SESSION['edit_uname']);
$edit_fname = isset($_SESSION['edit_fname']);
$edit_lname = isset($_SESSION['edit_lname']);
$edit_email = isset($_SESSION['edit_email']);
$edit_dob = isset($_SESSION['edit_dob']);
$edit_password = isset($_SESSION['edit_password']);
