<?php
    session_start();
    // Check if the user is logged in
    /*if (!isset($_SESSION['user_id'])) {
        header("Location: ../backend/invalid_access.php"); // Redirect to login if not logged in
        exit();
    }*/
    
    include '../backend/budget_backend.php';
    include '../backend/budget_output_backend.php';
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
            include "sidebar.php"; 
        ?>

        <!-- CONTAINER -->
        <section class="container">
            <div class="page_header">
                <div class="output_headers">
                    <div class="output_title">
                        <h1><?php echo $budget_info['bud_title']; ?></h1>
                        <span class="output_desc"><?php echo $budget_info['bud_desc']; ?></span>
                    </div>

                    <div class="output_btn">
                        <button class="btn_add btns" id="btn_new" name="btn_add"><i class='bx bx-plus'></i>ADD ITEM</button>
                        <button class="btn_edit btns" id="btn_edit_main" name="btn_edit_main"><i class='bx bxs-edit'></i>EDIT</button>
                        <button class="btn_delete btns" id="btn_delete" name="btn_delete"><i class='bx bx-trash' ></i>DELETE</button>
                    </div>
                </div>
                <hr>
            </div>

            <div class="contents">
                <?php 
                    if (!checkData("SELECT * FROM budget_item WHERE bud_id = $bud_id")) {
                        ?> <div class="output_data">
                            <?php echo 'No data.'; ?>
                        </div>
                    <?php } else { ?>
                    <table>
                        <tr class="tbl_headers">
                            <th>NO.</th>
                            <th>ITEM</th>
                            <th>PURPOSE</th>
                            <th class="col_amnt">AMOUNT</th>
                            <th>EDIT OR DELETE</th>
                        </tr>

                        <?php
                            getBudgetContents($bud_id);
                        ?>
                    </table>
                <?php } ?>
            </div>
        </section>

        <div class="modal-bg" id="modal_1">
            <div class="modal-content bdgt-content">
                <div class="title">
                    <h2>Add Item</h2>
                    <i class='bx bx-x btn_cancel btn_c1'></i>
                </div>

                <form action="" method="post">
                <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="rbud_item_desc">Item: <b class="req_field">*</b></label>
                            <input type="text" name="modal_item" id="modal_item"
                                <?php if ($err_bud_items[1] == True) echo 'class="err_field"' ?>
                            >
                            <?php if ($err_bud_items[1] == True) echo '<span class="err_message">Please enter an item name.</span>'; ?>
                        </div>

                        <div class="modal_fields">
                            <label for="rbud_item_desc">Purpose: <b class="req_field">*</b></label>
                            <input type="text" name="modal_purp" id="modal_purp"
                                <?php if ($err_bud_items[2] == True) echo 'class="err_field"' ?>
                            >
                            <?php if ($err_bud_items[2] == True) echo '<span class="err_message">Please enter its purpose.</span>'; ?>
                        </div>

                        <div class="modal_fields">
                            <label for="rbud_item_desc">Amount: <b class="req_field">*</b></label>
                            <input type="text" name="modal_amnt" id="modal_amnt" 
                                <?php if ($err_bud_items[3] == True) echo 'class="err_field"' ?>
                            >
                            <?php if ($err_bud_items[3] == True) echo '<span class="err_message">Please enter its amount.</span>'; ?>
                        </div>
                    </div>    

                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="rbud_item_desc">Note:</label>
                            <input type="text" name="modal_desc" id="modal_desc" class="modal_desc">
                        </div>
                    </div>

                    <div class="modal_field_rows modal_btns">
                        <input type="submit" value="ADD ITEM" name="btn_create" class="btn_modal btn_create" id="btn_create">
                    </div>
                </form>
            </div>
        </div>

        <div class="modal_bg_edit" id="#modal_2">
            <div class="modal-content bdgt-content">
                <div class="title">
                    <h2>Update Budget Plan Details</h2>
                    <i class='bx bx-x btn_cancel btn_c2'></i>
                </div>

                <form action="" method="post">
                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="modal_title">Title: <b class="req_field">*</b></label>
                            <input type="text" name="modal_title" id="modal_title"
                                <?php 
                                    if ($err_bud_title[1] == True) echo 'class="err_field"';   
                                    echo 'value="' . $budget_info['bud_title'] . '"';
                                ?> >
                            <?php if ($err_bud_title[1] == True) echo '<span class="err_message">Please enter a title. Less than 50 characters only.</span>'; ?>
                        </div>
                    </div>
                    
                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="rmss_desc">Description:</label>
                            <input type="text" name="modal_desc" id="modal_desc" class="modal_desc 
                            <?php 
                                if ($err_bud_title[2] == True) echo 'err_field';
                            ?>"
                            <?php echo 'value="' . $budget_info['bud_desc'] . '"'; ?>>
                            <?php if ($err_bud_title[2] == True) echo '<span class="err_message">Characters must be less than 300 characters only.</span>'; ?>
                        </div>
                    </div>

                    <div class="modal_field_rows modal_btns">
                        <input type="submit" value="UPDATE" name="btn_update" class="btn_modal btn_update" id="btn_update">
                    </div>
                </form>
            </div>
        </div>

        <script type="text/javascript" src="../scripts/modal.js"></script>
        <script type="text/javascript" src="../scripts/budget.js"></script>
    </body>
</html>