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

    function deleteData($table, $column, $id) {
        include 'db_conn.php';

        $sql = "DELETE FROM $table WHERE $column = $id;";
        
        $result = mysqli_query($db_connect, $sql);

        mysqli_close( $db_connect );
    }

    // Function to calculate total income or expenses
    function calculateTotal($db_connect, $table, $user_id, $amount_column) {
        $sql = "SELECT SUM($amount_column) AS total FROM $table WHERE user_id = $user_id";
        $result = mysqli_query($db_connect, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?: 0; // Return 0 if total is NULL
    }

    // Function to calculate average income or expenses
    function calculateAverage($db_connect, $table, $user_id, $amount_column) {
        $sql = "SELECT AVG($amount_column) AS average FROM $table WHERE user_id = $user_id";
        $result = mysqli_query($db_connect, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['average'] ?: 0; // Return 0 if average is NULL
    }
?>
