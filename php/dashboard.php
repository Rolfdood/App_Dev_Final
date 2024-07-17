<?php
    session_start();
    //check for the session UID
    if(!isset($_SESSION['user_id'])){
        header('Location: ../backend/invalid_access.php');
    } else {
        //retrieve UID from db
        include '../backend/db_conn.php';
        
        $UID = $_SESSION['user_id'];
        $check_query = "SELECT * FROM user WHERE user_id = '$UID'";
        
        $result = mysqli_query($db_connect, $check_query);
        
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_uname'] = $row['user_uname'];
    }

    include '../backend/dashboard_backend.php';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../src/assets/logo_colored.png" type="image/icon type">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../styles/general.css">
        <link rel="stylesheet" href="../styles/user.css">
        <link rel="stylesheet" href="../styles/dashboard.css">
        <link rel="stylesheet" href="../styles/budget.css">
        <title>Dashboard</title>
    </head>

    <body>
        <!-- NAVBAR -->
        <?php 
            $current = 'dashboard';
            include "../miscs/sidebar.php";  
        ?>

        <!-- CONTAINER -->
        <section class="container">
            <div class="page_header">
                <div class="dashboard_greetings">
                    <span class="greetings">Hello, <span class="uname"><?php echo $_SESSION['user_uname']; ?></span>!</span>
                </div>
                <hr>
            </div>

            <div class="contents">
                <div class="dashboard_cont ssummary">
                    <h3>Summary:</h3>
                    <div class="summary_cont">
                        <ul class="summaries">
                            <li>
                                <i class='bx bxs-credit-card-alt icon' ></i>
                                <span class="summary_deets">
                                    <b>1000.00</b>
                                    Total Expenses
                                </span>
                            </li>

                            <li>
                                <i class='bx bxs-coin icon' ></i>
                                <span class="summary_deets">
                                    <b>1000.00</b>
                                    Remaining Allowance
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="dashboard_others">
                    <div class=" dashboard_cont dashboard_budget">
                        <h3>Budget Plans:</h3>
                        <?php 
                            if (!checkData("SELECT * FROM budget WHERE user_id = $UID")) {
                                ?> <div class="output_data">
                                    <?php echo 'No data.'; ?>
                                </div>
                            <?php } else { ?>
                            <table>
                                <tr class="tbl_headers">
                                    <th>NO.</th>
                                    <th>BUDGET TITLE</th>
                                </tr>

                                <?php
                                    getBudget($UID);
                                ?>
                            </table>
                        <?php } ?>
                    </div>

                    <div class="dashboard_cont quotations">
                        <div class="quote_background">
                            <span id="quote"><?php echo $quotes[0]?></span>
                            <span id="author">~ <?php echo $quotes[1]?></span>
                        </div>
                    </div>
                </div>

                
            </div>


            <!--<a href="../backend/invalid_access.php">ERROR</a>
            <a href="budget_output.php">OUTPUT</a>
            <a href="../miscs/edit_data.php">EDITPAGE</a> -->
        </section>
    </body>
</html>