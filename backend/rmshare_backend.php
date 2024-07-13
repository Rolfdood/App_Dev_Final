<?php
    include 'db_functions.php';

    function getRMShare($user_id) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_conn.php';

        $sql = "SELECT * FROM rmshare WHERE user_id = $user_id";

        $result = mysqli_query($db_connect, $sql);

        $cnt = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo "<td class='tbl_rnum'>$cnt</td>"; ?>
                <td>
                    <div class="tbl_rtitle">
                        <span class="rmshare_title"><?php echo $row['rmshare_title']; ?></span>
                        <span class="bud_date_modified">DATE MODIFIED: <?php echo $row['date_modified']; ?></span>
                        <span class="rmshare_desc"><?php if (!empty($row['rmshare_desc'])) echo '>> ' .  $row['rmshare_desc']; ?></span>
                    </div>
                </td>
                <td class="bud_btns">
                    <div class="tbl_rbtns">
                        <a href="budget_output.php/?bud=<?php echo $row['rmshare_id']; ?>" class="btn_edit btns" id="btn_edit">VIEW</a>
                        <a href="#" class="btn_delete btns" id="btn_delete">DELETE</a>
                    </div>
                </td>
            </tr>
        <?php
            $cnt++;
        }

        mysqli_close( $db_connect );
    }

    function insertRMShare($user_id, $rmsh_data, $rmsh_util) {
        // ADD USER_ID IN DATABASE INSERT
        include 'db_conn.php';

        $cur_date = setModifiedDate();
        $sql = "INSERT INTO rmshare (user_id, rmshare_title, rmshare_ntenants, rmshare_sdate, rmshare_edate,
                    rmshare_uelec, rmshare_uwater, rmshare_uothers, rmshare_desc, date_modified) 
                VALUES ($user_id, '$rmsh_data[0]', '$rmsh_data[1]', '$rmsh_data[2]', '$rmsh_data[3]', '$rmsh_util[0]',
                    '$rmsh_util[1]', '$rmsh_util[2]', '$rmsh_data[4]', '$cur_date')";

        $result = mysqli_query($db_connect, $sql);

        /* if (mysqli_query($db_connect, $sql)) {
            $res_message = "Registration successful";
        } else {
            $res_message = "Error: " . $sql . "<br>" mysqli_error($db_connect);
        }*/

        mysqli_close($db_connect);
    }

?>