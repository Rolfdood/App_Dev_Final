<?php
    $err_create = array(False, False, False, False);
 
    if (isset($_POST['btn_create'])) {
        $rmss_title = htmlspecialchars(strip_tags($_POST['rmss_title']));
        $rmss_tenants = htmlspecialchars(strip_tags($_POST['rmss_tenants']));
        $rmss_sdate = htmlspecialchars(strip_tags($_POST['rmss_sdate']));
        $rmss_ldate = htmlspecialchars(strip_tags($_POST['rmss_ldate']));
        $rmss_bills[0] = htmlspecialchars(strip_tags($_POST['rmss_uelec']));
        $rmss_bills[1] = htmlspecialchars(strip_tags($_POST['rmss_uwater']));
        $rmss_bills[2] = htmlspecialchars(strip_tags($_POST['rmss_uothers']));
        $rmss_desc = htmlspecialchars(strip_tags($_POST['rmss_desc']));

        if (empty($rmss_title)) {
            $err_create[0] = True;
        }

        if (empty($rmss_tenants)) {
            $err_create[1] = True;
        }

        if (empty($rmss_sdate)) {
            $err_create[2] = True;
        }

        if (empty($rmss_sdate)) {
            $err_create[3] = True;
        }

        foreach ($rmss_bills as $key => $value) {
            if (empty($value)) {
                $rmss_bills[$key] = 0;
            }
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
        <title>Room Share</title>
    </head>

    <body>
        <!-- NAVBAR -->
        <?php 
            $current = 'rmshare';
            include "sidebar.php"; 
        ?>

        <!-- CONTAINER -->
        <section class="container">
            <div class="page_header">
                <h1>Room Share</h1>
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
            <div class="modal-content rmss-content">
                <div class="title">
                    <h2>Create a Room Sharing Sheet</h2>
                    <button class="btn_cancel">+</button>
                </div>

                <form action="" method="post">
                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="rmss_title">Title: <b class="req_field">*</b></label>
                            <input type="text" name="rmss_title" id="rmss_title"<?php if ($err_create[0] == True) echo 'class="err_field"' ?>
                            >
                            <?php if ($err_create[0] == True) echo '<span class="err_message">Please enter a title.</span>'; ?>
                        </div>
                    </div>

                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="rmss_tenants">Number of Tenants: <b class="req_field">*</b></label>
                            <input type="text" name="rmss_tenants" id="rmss_tenants"<?php if ($err_create[1] == True) echo 'class="err_field"' ?>
                            >
                            <?php if ($err_create[1] == True) echo '<span class="err_message">Please enter a title.</span>'; ?>
                        </div>

                        <div class="modal_fields">
                            <label for="rmss_sdate">Starting Date: <b class="req_field">*</b></label>
                            <input type="date" name="rmss_sdate" id="rmss_sdate"<?php if ($err_create[2] == True) echo 'class="err_field"' ?>
                            >
                            <?php if ($err_create[2] == True) echo '<span class="err_message">Please enter a title.</span>'; ?>
                        </div>

                        <div class="modal_fields">
                            <label for="rmss_ldate">Ending Date: <b class="req_field">*</b></label>
                            <input type="date" name="rmss_ldate" id="rmss_ldate"<?php if ($err_create[3] == True) echo 'class="err_field"' ?>
                            >
                            <?php if ($err_create[3] == True) echo '<span class="err_message">Please enter a title.</span>'; ?>
                        </div>
                    </div>

                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="rmss_uelec">Amount of Electricity:</label>
                            <input type="number" name="rmss_uelec" id="rmss_uelec">
                        </div>

                        <div class="modal_fields">
                            <label for="rmss_uwater">Amount of Water:</label>
                            <input type="text" name="rmss_uwater" id="rmss_uwater">
                        </div>

                        <div class="modal_fields">
                            <label for="rmss_uothers">Total of Other Utilities:</label>
                            <input type="text" name="rmss_uothers" id="rmss_uothers">
                        </div>
                    </div>
                    
                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="rmss_desc">Description:</label>
                            <input type="text" name="rmss_desc" id="rmss_desc">
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