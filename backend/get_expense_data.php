<?php
include 'db_conn.php'; 

if (isset($_GET['exp_id'])) {
    $exp_id = $_GET['exp_id'];

    // Fetch expense data from the database
    $sql = "SELECT * FROM expenses WHERE exp_id = $exp_id";
    $result = mysqli_query($db_connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Return expense data as JSON
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Expense not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
