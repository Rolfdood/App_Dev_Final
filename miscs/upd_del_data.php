<?php 
    session_start();
    // Check if the user is logged in
    if (!isset($_SESSION['user_uname'])) {
        header("Location: ../backend/invalid_access.php"); // Redirect to login if not logged in
        exit();
    }
    
    include '../backend/upd_del_backend.php';
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
        <link rel="stylesheet" href="../styles/edit_page.css">
        <link rel="stylesheet" href="../styles/rm_bud.css">
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
                            <?php 
                                if ($action == 'upd') echo '<h1>Update Data</h1>';
                                elseif ($action == 'del') echo '<h1>Delete Data</h1>';
                            ?>
                        </div>

                        <div class="output_btn">
                                <a href="../miscs/budget_output.php?bud=<?php echo $return; ?>" class="btn_back btns"><i class='bx bx-arrow-back'></i>BACK</a>
                        </div>
                    </div>
                    <hr>

                    <?php 
                        if ($sheet == 'budget_item') 
                            include 'budget_item.php';
                        elseif ($sheet == 'income')
                            include 'income_item.php';
                    ?>
                    
                </div>
            </div>
        </section>

        <div class="mod_confirm" id="mod_confirm">
            <div class="modal-content confirm-content">
                <div class="title">
                    <h2>Confirm Delete</h2>
                </div>

                <div class="modal_field confirm-cnt">
                    <span>Are you sure you want to delete this item? You can't undo this after deleting.</span>
                </div>

                <div class="modal_field_rows modal_btns">
                    <form action="">
                        <button class="btn_delete confirm_del" id="delete">DELETE</button>
                    </form>
                    <button class="btn_cancel2" id="btn_cancel2">CANCEL</button>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="../scripts/modal.js"></script>
    </body>
</html>