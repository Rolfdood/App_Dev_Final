<?php
    include '../backend/db_functions.php';
    $current = $_GET['type'];   // BUDGET or ROOM
    $action = $_GET['action'];  // UPDATE or CREATE
    $sheet = $_GET['sheet'];    // DATABASE TABLE
    $item_id = $_GET['id'];     // ITEM ID
    $return = $_GET['ret'];

    $data = get_data($sheet, $item_id);

    $err_bud_items = [False, False, False, False];
    $err_bud_title = [False, False, False];
    
    if (isset($_POST['btn_update'])) {
        $bud_item[0] = htmlspecialchars(strip_tags($_POST['edit_item']));
        $bud_item[1] = htmlspecialchars(strip_tags($_POST['edit_purp']));
        $bud_item[2] = htmlspecialchars(strip_tags($_POST['edit_amnt']));
        $bud_item[3] = htmlspecialchars(strip_tags($_POST['edit_desc']));

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
            update_item($sheet, $bud_item, $item_id); 
            header("Location: budget_output.php?bud=$return");
        }
    }

    if (isset($_POST['btn_del'])) {
        if ($sheet == 'budget_item') $col = 'bud_item_id';
        delete_item($sheet, $col, $item_id);
        header("Location: budget_output.php?bud=$return");
    }
    
    function get_data($table, $id) {
        include 'db_conn.php';

        $sql = "SELECT * FROM $table WHERE bud_item_id = $id";

        $result = mysqli_query($db_connect, $sql);

        $row = mysqli_fetch_array($result);

        mysqli_close( $db_connect );

        return $row;
    }

    function update_item($table, $data, $id) {
        include 'db_conn.php';

        $cur_date = setModifiedDate();

        if ($table == 'budget_item')
            $sql = "UPDATE budget_item
                SET bud_item_name = '$data[0]', bud_item_purp = '$data[1]', bud_item_amount = $data[2], bud_item_desc = '$data[3]', date_modified = '$cur_date'
                    WHERE bud_item_id = $id";
        else if ($table == 'room_sheet')
            $sql = "";
        
        $result = mysqli_query($db_connect, $sql);

        mysqli_close( $db_connect );
    }

    function delete_item($table, $column, $id) {
        include 'db_conn.php';

        $sql = "DELETE FROM $table WHERE $column = $id";
        
        $result = mysqli_query($db_connect, $sql);

        mysqli_close( $db_connect );
    }
?>