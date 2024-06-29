<?php
    $err_create_title = False;

    if (isset($_POST['btn_create'])) {
        $bud_title = htmlspecialchars(strip_tags($_POST['modal_title']));
        $bud_desc = htmlspecialchars(strip_tags($_POST['modal_desc']));

        if (empty($bud_title)) {
            $err_create_title = True;
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
        <link rel="stylesheet" href="../styles/user.css">
        <link rel="stylesheet" href="../styles/share.css">
        <link rel="stylesheet" href="../styles/modal.css">
        <title>Budget Plan</title>
    </head>

    <body>
        <!-- NAVBAR -->
        <?php 
            $current = 'budget';
            include "sidebar.php"; 
        ?>

        <!-- CONTAINER -->
        <section class="container">
            <div class="page_header">
                <h1>Budget Plan</h1>
                <hr>
            </div>

            <div class="contents">
                <?php include '../backend/create_rm_share_sheet.php'?>

                <button class="create_new" id="create_new">
                    <i class='bx bx-plus'></i>
                    <span>ADD NEW</span>
                </button>
            </div>
        </section>

        <div class="modal-bg">
            <div class="modal-content bdgt-content">
                <div class="title">
                    <h2>Create a Budget Plan</h2>
                    <button class="btn_cancel">+</button>
                </div>

                <form action="" method="post">
                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="modal_title">Title: <b class="req_field">*</b></label>
                            <input type="text" name="modal_title" id="modal_title"
                                <?php if ($err_create_title == True) echo 'class="err_field"' ?>
                            >
                            <?php if ($err_create_title == True) echo '<span class="err_message">Please enter a title.</span>'; ?>
                        </div>
                    </div>
                    
                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="rmss_desc">Description:</label>
                            <input type="text" name="modal_desc" id="modal_desc" class="modal_desc">
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