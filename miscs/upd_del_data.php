<?php 
    $user = 11;
    /*
    session_start();
    // Check if the user is logged in
    /*if (!isset($_SESSION['user_id'])) {
        header("Location: ../backend/invalid_access.php"); // Redirect to login if not logged in
        exit();
    } */
    
    include '../backend/upd_del_backend.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../styles/general.css">
        <link rel="stylesheet" href="../styles/user.css">
        <link rel="stylesheet" href="../styles/edit_page.css">
        <title>Edit Info</title>
    </head>
    <body>
        <!-- NAVBAR -->
        <?php
            include "sidebar.php"; 
        ?>

        <section class="container">
            <div class="edit_section">
                <div class="edit_content">
                    <div class="output_headers">
                        <div class="output_title">
                            <h1>Update Data</h1>
                        </div>
                    </div>
                    <hr>

                    <form action="" method="post">
                        <div class="edit_fields">
                            <label for="rbud_item_desc">Item: <b class="req_field">*</b></label>
                            <input type="text" name="edit_item" id="edit_item"
                                <?php if ($err_bud_items[1] == True) echo 'class="err_field"';
                                    echo 'value="' . $data['bud_item_name'] . '"'; ?>>
                            <?php if ($err_bud_items[1] == True) echo '<span class="err_message">Please enter an item name.</span>'; ?>
                        </div>

                        <div class="edit_fields">
                            <label for="rbud_item_desc">Purpose: <b class="req_field">*</b></label>
                            <input type="text" name="edit_purp" id="edit_purp"
                                <?php if ($err_bud_items[2] == True) echo 'class="err_field"';
                                    echo 'value="' . $data['bud_item_purp'] . '"'; ?>>
                            <?php if ($err_bud_items[2] == True) echo '<span class="err_message">Please enter its purpose.</span>'; ?>
                        </div>

                        <div class="edit_fields">
                            <label for="rbud_item_desc">Amount: <b class="req_field">*</b></label>
                            <input type="text" name="edit_amnt" id="edit_amnt" 
                                <?php if ($err_bud_items[3] == True) echo 'class="err_field"';
                                    echo 'value="' . $data['bud_item_amount'] . '"'; ?>>
                            <?php if ($err_bud_items[3] == True) echo '<span class="err_message">Please enter its amount.</span>'; ?>
                        </div>

                        <div class="edit_fields">
                            <label for="rbud_item_desc">Note:</label>
                            <input type="text" name="edit_desc" id="edit_desc" class="edit_desc" <?php echo 'value="' . $data['bud_item_desc'] . '"'; ?>>
                        </div>

                        <div class="edit_fields btns">
                            <input type="submit" value="UPDATE ITEM" name="btn_update" class="btn_update" id="btn_update">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>