<?php
    $current = $_GET['type'];   // BUDGET or ROOM
    $action = $_GET['action'];  // UPDATE or CREATE
    $sheet = $_GET['sheet'];    // DATABASE TABLE
    $item_id = $_GET['id'];     // ITEM ID

    $data = get_data($sheet, $item_id);

    $err_bud_items = [False, False, False, False];
    $err_bud_title = [False, False, False];
    /*
    if ($action == 'upd') 
        update_item($sheet, $data)
    }
    */
    function get_data($table, $id) {
        include 'db_conn.php';

        $sql = "SELECT * FROM $table WHERE bud_item_id = $id";

        $result = mysqli_query($db_connect, $sql);

        $row = mysqli_fetch_array($result);

        mysqli_close( $db_connect );

        return $row;
    }

    function update_item($table, $data) {
        include 'db_conn.php';

        if ($table == 'budget_item')
            $sql = "";
        else if ($table == 'room_sheet')
            $sql = "";
        
        $result = mysqli_query($db_connect, $sql);

        mysqli_close( $db_connect );
    }

    function delete_item($table, $data) {
        include 'db_conn.php';

        if ($table == 'budget_item')
            $sql = "";
        else if ($table == 'room_sheet')
            $sql = "";
        
        $result = mysqli_query($db_connect, $sql);

        mysqli_close( $db_connect );
    }
?>