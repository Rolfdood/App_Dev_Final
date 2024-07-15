<?php
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
?>

