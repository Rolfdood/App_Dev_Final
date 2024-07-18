<?php
include 'db_conn.php';

if (isset($_GET['inc_id'])) {
    $inc_id = $_GET['inc_id'];

    // Fetch income data from the database
    $sql = "SELECT * FROM income WHERE inc_id = $inc_id";
    $result = mysqli_query($db_connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Return income data as JSON
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Income not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>