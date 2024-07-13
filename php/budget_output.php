<?php
    session_start();
    include '../backend/budget_backend.php';

    $bud_id = $_GET['bud'];
    $budget_info = getSheetInfo('budget','bud_id', $bud_id);

    $bud_item;
    $err_bud_items = [False, False, False, False];

    if (isset($_POST['btn_create'])) {
        $bud_item[0] = htmlspecialchars(strip_tags($_POST['modal_item']));
        $bud_item[1] = htmlspecialchars(strip_tags($_POST['modal_purp']));
        $bud_item[2] = htmlspecialchars(strip_tags($_POST['modal_amnt']));
        $bud_item[3] = htmlspecialchars(strip_tags($_POST['modal_desc']));

        if (empty(trim($bud_item[0]))) {
            $err_bud_items[1] = True;
            $err_bud_items[0] = True;
        }

        if (empty(trim($bud_item[1]))) {
            $err_bud_items[2] = True;
            $err_bud_items[0] = True;
        }

        if (empty(trim($bud_item[2]))) {
            $err_bud_items[3] = True;
            $err_bud_items[0] = True;
        }

        if (!$err_bud_items[0]) {
            insertBudgetContent($bud_id, $bud_item);
        }
    }
    // Check if the user is logged in
    /*if (!isset($_SESSION['user_id'])) {
        header("Location: ../backend/invalid_access.php"); // Redirect to login if not logged in
        exit();
    }*/
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
                        <button class="btn_add btns" id="btn_new" name="btn_add">ADD ITEM</button>
                        <button class="btn_edit btns" id="btn_edit" name="btn_edit">EDIT</button>
                        <button class="btn_delete btns" id="btn_delete" name="btn_delete">DELETE</button>
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
                    <i class='bx bx-x btn_cancel'></i>
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
                        <input type="submit" value="ADD ITEM" name="btn_create" class="btn_create" id="btn_create">
                    </div>
                </form>
            </div>
        </div>

        <script type="text/javascript" src="../scripts/modal.js"></script>
        <script type="text/javascript" src="../scripts/budget.js"></script>
    </body>
</html>