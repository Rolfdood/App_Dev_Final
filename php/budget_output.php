<?php
    /*
    session_start();
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
                        <h1>Title</h1>
                        <span class="output_desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie augue orci, sit amet commodo sapien mollis at. Ut posuere hendrerit rhoncus. Quisque laoreet magna id lectus congue, eget elementum metus placerat. Mauris sollicitudin libero at accumsan venenatis. Aliquam luctus, leo at faucibus interdum, metus ligula dictum nulla, ut sagittis orci sapien vitae quam.</span>
                    </div>

                    <div class="output_btn">
                        <button class="btn_add btns" id="btn_add" name="btn_add">ADD ITEM</button>
                        <button class="btn_edit btns" id="btn_edit" name="btn_edit">EDIT</button>
                        <button class="btn_delete btns" id="btn_delete" name="btn_delete">DELETE</button>
                    </div>
                </div>
                <hr>
            </div>

            <div class="output_data">
                <?php echo $_SESSION['bud_id']; ?>
            </div>
        </section>

        <div class="modal-bg">
            <div class="modal-content bdgt-content">
                <div class="title">
                    <h2>Add Item</h2>
                    <i class='bx bx-x btn_cancel'></i>
                </div>

                <form action="" method="post">
                <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="rmss_desc">Item:</label>
                            <input type="text" name="modal_desc" id="modal_desc" class="modal_desc">
                        </div>

                        <div class="modal_fields">
                            <label for="rmss_desc">Purpose:</label>
                            <input type="text" name="modal_desc" id="modal_desc" class="modal_desc">
                        </div>

                        <div class="modal_fields">
                            <label for="rmss_desc">Amount:</label>
                            <input type="text" name="modal_desc" id="modal_desc" class="modal_desc">
                        </div>
                    </div>    

                    <div class="modal_field_rows">
                        <div class="modal_fields">
                            <label for="rmss_desc">Note:</label>
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
    </body>
</html>