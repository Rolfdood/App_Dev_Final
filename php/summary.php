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
    <?php
    session_start();
    include '../backend/db_conn.php';
    include '../backend/db_functions.php';

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location:login.php"); // Redirect to login if not logged in
        exit();
    }

    // Function to calculate total income or expenses
    function calculateTotal($db_connect, $table, $user_id, $amount_column) {
        $sql = "SELECT SUM($amount_column) AS total FROM $table WHERE user_id = $user_id";
        $result = mysqli_query($db_connect, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?: 0; // Return 0 if total is NULL
    }

    // Function to calculate average income or expenses
    function calculateAverage($db_connect, $table, $user_id, $amount_column) {
        $sql = "SELECT AVG($amount_column) AS average FROM $table WHERE user_id = $user_id";
        $result = mysqli_query($db_connect, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['average'] ?: 0; // Return 0 if average is NULL
    }

    // Get user ID
    $user_id = $_SESSION['user_id'];

    // Calculate totals and averages
    $totalIncome = calculateTotal($db_connect, 'income', $user_id, 'inc_amount');
    $totalExpenses = calculateTotal($db_connect, 'expenses', $user_id, 'exp_amount');
    $averageIncome = calculateAverage($db_connect, 'income', $user_id, 'inc_amount');
    $averageExpenses = calculateAverage($db_connect, 'expenses', $user_id, 'exp_amount');

    $current = 'summary';
    include "sidebar.php";
    ?>

    <section class="container">
        <h1>Financial Summary</h1>
        <hr>
        <p>Total Income: <?php echo number_format($totalIncome, 2); ?></p>
        <p>Total Expenses: <?php echo number_format($totalExpenses, 2); ?></p>
        <p>Average Income: <?php echo number_format($averageIncome, 2); ?></p>
        <p>Average Expenses: <?php echo number_format($averageExpenses, 2); ?></p>
    </section>
</body>
</html>
