<?php
    include 'db_functions.php';

    function getBudget($user_id) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_conn.php';

        $sql = "SELECT * FROM budget WHERE user_id = $user_id";

        $result = mysqli_query($db_connect, $sql);

        $cnt = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo "<td class='tbl_rnum'>$cnt</td>"; ?>
                <td>
                    <div class="tbl_rtitle">
                        <span class="bud_title"><?php echo $row['bud_title']; ?></span>
                        <span class="bud_date_modified">DATE MODIFIED: <?php echo $row['date_modified']; ?></span>
                        <span class="bud_desc"><?php if(!empty($row['bud_desc'])) echo '>> ' . $row['bud_desc']; ?></span>
                    </div>
                </td>
                <td class="bud_btns">
                    <div class="tbl_rbtns">
                        <a href="../miscs/budget_output.php?bud=<?php echo $row['bud_id']; ?>" class="btn_edit btns" id="btn_edit">OPEN</a>
                        <!--<a href="#" class="btn_delete btns" id="btn_delete">DELETE</a>-->
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
        include 'db_conn.php';

        $cur_date = setModifiedDate();
        $sql = "INSERT INTO budget (user_id, bud_title, bud_desc, date_modified) VALUES ('$user_id', '$bud_title', '$bud_desc', '$cur_date')";

        $result = mysqli_query($db_connect, $sql);

        /* if (mysqli_query($db_connect, $sql)) {
            $res_message = "Registration successful";
        } else {
            $res_message = "Error: " . $sql . "<br>" mysqli_error($db_connect);
        }*/

        mysqli_close($db_connect);
    }

    function deleteBudget($bud_id) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_conn.php';

        $sql = "INSERT INTO budget (user_id, bud_title, bud_desc, date_modified) VALUES ('$user_id', '$bud_title', '$bud_desc', '$cur_date')";

        $result = mysqli_query($db_connect, $sql);

        /* if (mysqli_query($db_connect, $sql)) {
            $res_message = "Registration successful";
        } else {
            $res_message = "Error: " . $sql . "<br>" mysqli_error($db_connect);
        }*/

        mysqli_close($db_connect);
    }


    // BUDGET ITEMS FUNCTIONS ------------------------------------------------------------------------------------------------------------------------------------

    function insertBudgetContent($bud_id, $bud_item) {
        include 'db_conn.php';

        $cur_date = setModifiedDate();
        $sql = "INSERT INTO budget_item (bud_id, bud_item_name, bud_item_purp, bud_item_amount, bud_item_desc, date_modified) 
                VALUES ($bud_id, '$bud_item[0]', '$bud_item[1]', '$bud_item[2]', '$bud_item[3]', '$cur_date')";

        $result = mysqli_query($db_connect, $sql);

        mysqli_close($db_connect);
    }
    
    function getBudgetContents($sheet_id) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_conn.php';

        $sql = "SELECT * FROM budget_item WHERE bud_id = $sheet_id";

        $result = mysqli_query($db_connect, $sql);

        $cnt = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo "<td class='tbl_rnum'>$cnt</td>"; ?>
                <td class="bud_item">
                    <div class="tbl_rtitle">
                        <span class="bud_item_name"><?php echo $row['bud_item_name']; ?></span>
                        <span class="bud_desc"><?php echo $row['bud_item_desc']; ?></span>
                    </div>
                </td>
                <td class="bud_item_purp">
                    <span class="bud_item_purp"><?php echo $row['bud_item_purp']; ?></span>
                </td>
                <td class="bud_item_amount">
                    <span class="bud_item_amount"><?php echo $row['bud_item_amount']; ?></span>
                </td>
                <td class="bud_btns">
                    <div class="tbl_rbtns">
                        <a href="../miscs/upd_del_data.php?action=upd&type=bud&sheet=budget_item&id=<?php echo $row['bud_item_id'] . '&ret=' . $sheet_id; ?>" class="btn_edit btns" id="btn_edit">
                            EDIT
                        </a>
                        <a href="../miscs/upd_del_data.php?action=del&type=bud&sheet=budget_item&id=<?php echo $row['bud_item_id'] . '&ret=' . $sheet_id;  ?>" class="btn_delete btns" id="btn_delete" data-id="<?php echo $row['bud_item_id']; ?>">DELETE</a>
                    </div>
                </td>
            </tr>
        <?php
            $cnt++;
        }

        mysqli_close( $db_connect );
    }
?>