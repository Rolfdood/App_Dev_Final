<?php
    session_start();
    include '../backend/db_conn.php';
    include '../backend/db_functions.php';

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location:login.php"); // Redirect to login if not logged in
        exit();
    }

    // Get user ID
    $user_id = $_SESSION['user_id'];

    // Calculate totals and averages
    $totalIncome = calculateTotal($db_connect, 'income', $user_id, 'inc_amount');
    $totalExpenses = calculateTotal($db_connect, 'expenses', $user_id, 'exp_amount');
    $remaining = $totalIncome - $totalExpenses;
    $averageIncome = calculateAverage($db_connect, 'income', $user_id, 'inc_amount');
    $averageExpenses = calculateAverage($db_connect, 'expenses', $user_id, 'exp_amount');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/assets/logo_colored.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/summary.css">
    <link rel="stylesheet" href="../styles/user.css">
    <title>Financial Summary</title>
</head>
<body>
    <?php
        $current = 'summary';
        include "../miscs/sidebar.php";
    ?>

    <section class="container">
        <div class="page_header">
            <div class="output_headers">
                <h1>Financial Summary</h1>
                <span class="asOf"><b>AS OF &nbsp: &nbsp</b> <?php echo setModifiedDate(); ?></span>
            </div>
            <hr>
        </div>

        <div class="contents">
            <div class="summary_cont summary">
                <ul class="summaries">
                    <div class="main_summary">
                        <li>
                            <i class='bx bxs-credit-card-alt icon' id="i_exp"></i>
                            <span class="summary_deets">
                                <b><?php echo number_format($totalExpenses, 2); ?></b>
                                <span class="sub">Total Expenses</span>
                            </span>
                        </li>
                        
                        <li>
                            <i class='bx bxs-coin icon' id="i_inc"></i>
                            <span class="summary_deets">
                                <b><?php echo number_format($totalIncome, 2) ?></b>
                                <span class="sub">Total Income</span>
                            </span>
                        </li>

                        <li>
                            <i class='bx bxs-wallet' id="i_rem"></i>
                            <span class="summary_deets">
                                <b><?php echo number_format($remaining, 2); ?></b>
                                <span class="sub">Remaining Allowance</span>
                            </span>
                        </li>
                    </div>

                    <div class="other_summary">
                        <li>
                            <i class='bx bxs-objects-vertical-top' ></i>
                            <span class="summary_deets">
                                <b><?php echo number_format($averageExpenses, 2); ?></b>
                                <span class="sub">Average Expense</span>
                            </span>
                        </li>

                        <li>
                            <i class='bx bxs-objects-vertical-bottom'></i>
                            <span class="summary_deets">
                                <b><?php echo number_format($averageIncome, 2); ?></b>
                                <span class="sub">Average Income</span>
                            </span>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </section>
</body>
</html>
