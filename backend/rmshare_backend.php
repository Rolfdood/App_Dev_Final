<?php
    function checkData($sql_query) {
            // ADD USER_ID IN DATABASE INSERT
            include 'db_functions.php';
    
            $sql = $sql_query;
    
            $result = mysqli_query($db_connect, $sql);
    
            if (mysqli_num_rows($result) <= 0) {
                return false;
            } else {
                return true;
            }
        }

    function getRMShare($user_id) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_functions.php';

        $sql = "SELECT * FROM rmshare WHERE user_id = $user_id";

        $result = mysqli_query($db_connect, $sql);

        $cnt = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo "<td class='tbl_rnum'>$cnt</td>"; ?>
                <td>
                    <div class="tbl_rtitle">
                        <span class="rmshare_title"><?php echo $row['rmshare_title']; ?></span>
                        <span class="rmshare_desc"><?php echo $row['rmshare_desc']; ?></span>
                    </div>
                </td>
                <td class="bud_btns">
                    <div class="tbl_rbtns">
                        <a href="budget_output.php/?bud=<?php echo $row['bud_id']; ?>" class="btn_edit btns" id="btn_edit">
                            <?php $_SESSION['bud_id'] = $row['bud_id']; ?>
                            EDIT
                        </a>
                        <a href="budget_output.php/?bud=<?php echo $row['bud_id']; ?>" class="btn_delete btns" id="btn_delete">DELETE</a>
                    </div>
                </td>
            </tr>
        <?php
            $cnt++;
        }

        mysqli_close( $db_connect );
    }

    function insertRMShare($user_id, $title, $tenants, $sdate, $ldate, $utilities, $desc ) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_functions.php';

        $sql = "INSERT INTO rmshare (user_id, rmshare_title, rmshare_ntenants, rmshare_sdate, rmshare_edate, rmshare_uelec, rmshare_uwater, rmshare_uothers, rmshare_desc) VALUES ($user_id, '$title', $tenants, '$sdate', '$ldate', $utilities[0], $utilities[1], $utilities[2], '$desc')";

        $result = mysqli_query($db_connect, $sql);

        /* if (mysqli_query($db_connect, $sql)) {
            $res_message = "Registration successful";
        } else {
            $res_message = "Error: " . $sql . "<br>" mysqli_error($db_connect);
        }*/

        mysqli_close($db_connect);
    }

?>