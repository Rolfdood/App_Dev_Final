<?php
    session_start();
    $user = $_SESSION['user_id'];
    include '../backend/budget_backend.php';
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../backend/invalid_access.php"); // Redirect to login if not logged in
    }

    $errors = [False, False, False];

    if (isset($_POST['btn_create'])) {
        $bud_title = htmlspecialchars(strip_tags($_POST['modal_title']));
        $bud_desc = htmlspecialchars(strip_tags($_POST['modal_desc']));

        if (empty($bud_title) || dataLength($bud_title, 50)) {
            $errors[0] = True;
            $errors[1] = True;
        } 

        if (dataLength($bud_desc, 300)) {
            $errors[0] = True;
            $errors[2] = True;
        } 
        
        if (!$errors[0]) {
            insertBudget($user, $bud_title, $bud_desc);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../styles/general.css">
        <link rel="stylesheet" href="../styles/modal.css">
        <link rel="stylesheet" href="../styles/user.css">
        <link rel="stylesheet" href="../styles/budget.css">
        <link rel="stylesheet" href="../styles/rm_bud.css">
        <title>Budget Plan</title>
    </head>

    <body>
        <!-- NAVBAR -->
        <?php 
            $current = 'budget';
            include "../miscs/sidebar.php"; 
        ?>

        <!-- CONTAINER -->
        <section class="container">
            <div class="page_header">
                <div class="output_headers">
                    <h1>Budget Plan</h1>
                    <button class="create_new btns" id="btn_new">
                        <i class='bx bx-plus'></i>
                        <span>ADD NEW</span>
                    </button>
                </div>
                <hr>
            </div>

            <div class="contents">
                <?php 
                    if (!checkData("SELECT * FROM budget WHERE user_id = $user")) {
                        ?> <div class="output_data">
                            <?php echo 'No data.'; ?>
                        </div>
                    <?php } else { ?>
                    <table>
                        <tr class="tbl_headers">
                            <th>NO.</th>
                            <th>BUDGET</th>
                            <th>ACTIONS</th>
                        </tr>

                        <?php
                            getBudget($user);
                        ?>
                    </table>
                <?php } ?>
            </div>
        </section>

        <?php include '../miscs/modals.php'; ?>

        <div class="modal-bg" id="#modal_1">
            <div class="modal-content bdgt-content">
                <div class="title">
                    <h2>Create a Budget Plan</h2>
                    <i class='bx bx-x btn_cancel btn_c1'></i>
                </div>

                <form action="" method="post">
                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="modal_title">Title: <b class="req_field">*</b></label>
                            <input type="text" name="modal_title" id="modal_title"
                                <?php if ($errors[1] == True) echo 'class="err_field"' ?>
                            >
                            <?php if ($errors[1] == True) echo '<span class="err_message">Please enter a title. Less than 50 characters only.</span>'; ?>
                        </div>
                    </div>
                    
                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="rmss_desc">Description:</label>
                            <input type="text" name="modal_desc" id="modal_desc" class="modal_desc <?php if ($errors[2] == True) echo 'err_field' ?>">
                            <?php if ($errors[2] == True) echo '<span class="err_message">Characters must be less than 300 characters only.</span>'; ?>
                        </div>
                    </div>

                    <div class="modal_field_rows modal_btns">
                        <input type="submit" value="CREATE" name="btn_create" class="btn_create" id="btn_create">
                    </div>
                </form>
            </div>
        </div>

        <script type="text/javascript" src="../scripts/modal.js"></script>
    </body>
</html>