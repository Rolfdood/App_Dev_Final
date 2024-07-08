<?php
    function checkData($sql_query) {
            // ADD USER_ID IN DATABASE INSERT
            include 'db_functions.php';
    
            $sql = $sql_query;
            $valid = true;
            $result = mysqli_query($db_connect, $sql);
    
            if (mysqli_num_rows($result) <= 0) {
                return false;
            }

            mysqli_close( $db_connect );
            return $valid;
        }

    function getBudget($user_id) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_functions.php';

        $sql = "SELECT * FROM budget WHERE user_id = $user_id";

        $result = mysqli_query($db_connect, $sql);

        $cnt = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo "<td class='tbl_rnum'>$cnt</td>"; ?>
                <td>
                    <div class="tbl_rtitle">
                        <span class="bud_title"><?php echo $row['bud_title']; ?></span>
                        <span class="bud_desc"><?php echo $row['bud_desc']; ?></span>
                    </div>
                </td>
                <td class="bud_btns">
                    <div class="tbl_rbtns">
                        <a href="budget_output.php?bud=<?php echo $row['bud_id']; ?>" class="btn_edit btns" id="btn_edit">
                            <?php $_SESSION['bud_id'] = $row['bud_id']; ?>
                            EDIT
                        </a>
                        <a href="budget_output.php?bud=<?php echo $row['bud_id']; ?>" class="btn_delete btns" id="btn_delete">DELETE</a>
                    </div>
                </td>
            </tr>
        <?php
            $cnt++;
        }

        mysqli_close( $db_connect );
    }

    function insertBudget($user_id, $bud_title, $bud_desc) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_functions.php';

        $sql = "INSERT INTO budget (user_id, bud_title, bud_desc) VALUES ('$user_id', '$bud_title', '$bud_desc')";

        $result = mysqli_query($db_connect, $sql);

        /* if (mysqli_query($db_connect, $sql)) {
            $res_message = "Registration successful";
        } else {
            $res_message = "Error: " . $sql . "<br>" mysqli_error($db_connect);
        }*/

        mysqli_close($db_connect);
    }

    function getSheetInfo($sheet_id) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_functions.php';

        $sql = "SELECT * FROM budget WHERE $sheet_id = $sheet_id";

        $result = mysqli_query($db_connect, $sql);

        $row = mysqli_fetch_array($result);

        return $row;
    }

    function getBudgetInfo($bud_id) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_functions.php';

        $sql = "SELECT * FROM budget WHERE bud_id = $bud_id";

        $result = mysqli_query($db_connect, $sql);

        $row = mysqli_fetch_array($result);

        mysqli_close( $db_connect );
        return $row;
    }

    function getBudgetContents($sheet_id) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_functions.php';

        $sql = "SELECT * FROM budget_item WHERE $sheet_id = $sheet_id";

        $result = mysqli_query($db_connect, $sql);

        $cnt = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo "<td class='tbl_rnum'>$cnt</td>"; ?>
                <td>
                    <div class="tbl_rtitle">
                        <span class="bud_title"><?php echo $row['bud_item_name']; ?></span>
                        <span class="bud_desc"><?php echo $row['bud_item_desc']; ?></span>
                    </div>
                </td>
                <td>
                    <span class="bud_item_purp"><?php echo $row['bud_item_purp']; ?></span>
                </td>
                <td>
                    <span class="bud_item_amount"><?php echo $row['bud_item_amount']; ?></span>
                </td>
                <td class="bud_btns">
                    <div class="tbl_rbtns">
                        <a href="#" class="btn_edit btns" id="btn_edit">
                            EDIT
                        </a>
                        <a href="#" class="btn_delete btns" id="btn_delete">DELETE</a>
                    </div>
                </td>
            </tr>
        <?php
            $cnt++;
        }

        mysqli_close( $db_connect );
    }
?>