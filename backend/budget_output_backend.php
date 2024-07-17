<?php
    $bud_id = $_GET['bud'];
    $budget_info = getSheetInfo('budget','bud_id', $bud_id);

    $bud_item;
    $err_bud_items = [False, False, False, False];
    $err_bud_title = [False, False, False];

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

    if (isset($_POST['btn_update'])) {
        $bud_title = htmlspecialchars(strip_tags($_POST['modal_title']));
        $bud_desc = htmlspecialchars(strip_tags($_POST['modal_desc']));

        if (empty($bud_title) || dataLength($bud_title, 50)) {
            $err_bud_title[0] = True;
            $err_bud_title[1] = True;
        } 

        if (dataLength($bud_desc, 300)) {
            $err_bud_title[0] = True;
            $err_bud_title[2] = True;
        } 
        
        if (!$err_bud_title[0]) {
            updateSheet($bud_title, $bud_desc, $bud_id);
            header("Location: budget_output.php?bud=$bud_id");
        }
    }

    if (isset($_POST['confirm_del'])) {
        deleteBudget($bud_id);
        header('Location: ../php/budget.php');
    }

    function updateSheet($title, $desc, $id) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_conn.php';

        $cur_date = setModifiedDate();

        $sql = "UPDATE budget SET bud_title = '$title', bud_desc = '$desc', date_modified = '$cur_date' WHERE bud_id = $id";

        $result = mysqli_query($db_connect, $sql);

        mysqli_close($db_connect);
    }

    function deleteBudget($id) {
        include 'db_conn.php';

        $sql = "DELETE FROM budget WHERE bud_id = $id";
        
        $result = mysqli_query($db_connect, $sql);

        mysqli_close($db_connect);
    }
?>