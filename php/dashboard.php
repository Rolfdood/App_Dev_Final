<?php
    session_start();
    //check for the session UID
    if(!isset($_SESSION['user_uname'])){
        header('Location: login.php');
    } else {
        //retrieve UID from db
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
        $username = $_SESSION['user_uname'];
        $check_query = "SELECT * FROM user WHERE user_uname = '$username'";
        
        $result = mysqli_query($db_connect, $check_query);
        
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['user_id'];
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../styles/general.css">
        <link rel="stylesheet" href="../styles/user.css">
        <title>Dashboard</title>
    </head>

    <body>
        <!-- NAVBAR -->
        <?php 
            $current = 'dashboard';
            include "sidebar.php"; 
        ?>

        <!-- CONTAINER -->
        <section class="container">
            <h1>Dashboard</h1>
            <hr>
            <a href="../backend/invalid_access.php">ERROR</a>
            <a href="budget_output.php">OUTPUT</a>
        </section>
    </body>
</html>