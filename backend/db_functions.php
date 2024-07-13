<?php
    function setModifiedDate() {
        $date = date('Y-m-d', time());
        return $date;
    }

    function checkData($sql_query) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_conn.php';

        $sql = $sql_query;
        $valid = true;
        $result = mysqli_query($db_connect, $sql);

        if (mysqli_num_rows($result) <= 0) {
            return false;
        }
        
        mysqli_close( $db_connect );
        return $valid;
    }

    function getSheetInfo($table, $column, $sheet_id) {
        include 'db_conn.php';

        $sql = "SELECT * FROM $table WHERE $column = $sheet_id";

        $result = mysqli_query($db_connect, $sql);

        $row = mysqli_fetch_array($result);

        return $row;
    }

    function dataLength($data, $max) {
        if (strlen($data) > $max) {
            return True;
        } else { return False; }
    }
?>