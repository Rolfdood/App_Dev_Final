<?php
    // ADD USER_ID IN DATABASE INSERT
    include 'db_functions.php';

    $err_create_title = False;

    if (isset($_POST['btn_create'])) {
        $bud_title = htmlspecialchars(strip_tags($_POST['modal_title']));
        $bud_desc = htmlspecialchars(strip_tags($_POST['modal_desc']));

        if (empty($bud_title)) {
            $err_create_title = True;
        } else {
            include 'db_functions.php';

            $sql = "INSERT INTO budget (bud_title, bud_desc) VALUES
            ('$bud_title', '$bud_desc')";

            if (mysqli_query($db_connect, $sql)) {
                $res_message = "Registration successful";
            } else {
                $res_message = "Error: " . $sql . "<br>" . mysqli_error($db_connect);
            }
            mysqli_close($db_connect);
        }
    }
?>