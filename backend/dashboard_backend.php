<?php
    include 'db_functions.php';

    $quotes = randQuotations();

    $totalIncome = calculateTotal($db_connect, 'income', $user_id, 'inc_amount');
    $totalExpenses = calculateTotal($db_connect, 'expenses', $user_id, 'exp_amount');
    $remaining = $totalIncome - $totalExpenses;
    
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
            </tr>
        <?php
            if ($cnt == 5) break;
            $cnt++;
        }

        mysqli_close( $db_connect );
    }

    function randQuotations() {
        $quotes = array(
            'Savings today bring the fortress of security tomorrow.',
            'A penny saved is a penny earned, but a penny invested is a future secured.',
            'The art of saving is the art of wise living.',
            'Save wisely, and live happily.',
            'The future belongs to those who prepare for it today. Saving is the best preparation.'
        );

        $author = array(
            'Warren Buffett',
            'Benjamin Franklin',
            'Oprah Winfrey',
            'Suze Orman',
            'Malcolm X'
        );

        $random = rand(0, 4);

        $returned[0] = $quotes[$random];
        $returned[1] = $author[$random];

        return $returned;
    }
?>