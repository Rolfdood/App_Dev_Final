<?php
    $bud_id = $_GET['bud'];

    include 'db_conn.php';

    $sql = "DELETE FROM budget WHERE bud_id = $bud_id";
    
    $result = mysqli_query($db_connect, $sql);

    mysqli_close($db_connect);

    header('Location: ../php/budget.php');
?>