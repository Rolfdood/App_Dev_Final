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
    $current = 'summary';
    include "../miscs/sidebar.php"; 


    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location:login.php"); // Redirect to login if not logged in
        exit();
    }

    // Database connection 
    $database = [
        'name' => 'solospend_db',
        'host' => 'localhost',
        'pass' => '', 
        'user' => 'root' 
    ];

    $db_connect = mysqli_connect($database['host'], $database['user'], $database['pass'], $database['name']);

    if (mysqli_connect_errno()) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    // Function to calculate total income or expenses
    function calculateTotal($db_connect, $table, $user_id) {
        $sql = "SELECT SUM(amount_column) AS total FROM $table WHERE user_id = $user_id";
        $result = mysqli_query($db_connect, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?: 0; // Return 0 if total is NULL
    }

    // Function to calculate average income or expenses
    function calculateAverage($db_connect, $table, $user_id) {
        $sql = "SELECT AVG(amount_column) AS average FROM $table WHERE user_id = $user_id";
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

    // Display summary
    echo "<section class='container'>";
    echo "<h1>Financial Summary</h1>";
    echo "<hr>";
    echo "<p>Total Income: " . number_format($totalIncome, 2) . "</p>";
    echo "<p>Total Expenses: " . number_format($totalExpenses, 2) . "</p>";
    echo "<p>Average Income: " . number_format($averageIncome, 2) . "</p>";
    echo "<p>Average Expenses: " . number_format($averageExpenses, 2) . "</p>";
    echo "</section>";
    ?>
</body>
</html>
