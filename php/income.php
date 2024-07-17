<?php 
    session_start();
    include '../backend/db_conn.php'; 
    include '../backend/db_functions.php';

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); 
        exit();
    }

    include '../backend/db_conn.php';

    // Handle income addition
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_income'])) {
        $inc_date = $_POST['inc_date'];
        $inc_origin = $_POST['inc_origin'];
        $inc_type = $_POST['inc_type'];
        $inc_mot = $_POST['inc_mot'];
        $inc_amount = $_POST['inc_amount'];
        $inc_remarks = $_POST['inc_remarks'];
        $user_id = $_SESSION['user_id']; 

        // Input validation (add more robust validation as needed)
        if (empty($inc_date) || empty($inc_origin) || empty($inc_amount)) {
            echo "Please fill in all required fields.";
        } else {
            // Insert income into database
            $sql = "INSERT INTO income (user_id, inc_date, inc_origin, inc_type, inc_mot, inc_amount, inc_remarks)
                    VALUES ('$user_id', '$inc_date', '$inc_origin', '$inc_type', '$inc_mot', '$inc_amount', '$inc_remarks')";

            if (mysqli_query($db_connect, $sql)) {
                echo "Income added successfully.";
            } else {
                // Insert new income record
                $insert_sql = "INSERT INTO income (user_id, inc_date, inc_origin, inc_type, inc_mot, inc_amount, inc_remarks)
                            VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($db_connect, $insert_sql);
                mysqli_stmt_bind_param($stmt, "isssdss", $user_id, $inc_date, $inc_origin, $inc_type, $inc_mot, $inc_amount, $inc_remarks);
                if (mysqli_stmt_execute($stmt)) {
                    echo "Income added successfully.";
                } else {
                    echo "Error adding income: " . mysqli_stmt_error($stmt);
                }
            }
        }
    }

    // Handle income deletion
    if (isset($_POST['delete_income'])) {
        $inc_id = $_POST['inc_id'];

        // Delete income from database
        $sql = "DELETE FROM income WHERE inc_id = '$inc_id'";
        if (mysqli_query($db_connect, $sql)) {
            echo "Income deleted successfully.";
        } else {
            echo "Error deleting income: " . mysqli_error($db_connect);
        }
    }

    // Fetch incomes for the current user
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM income WHERE user_id = '$user_id'";
    $result = mysqli_query($db_connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/user.css">
    <link rel="stylesheet" href="../styles/modal.css">
    <link rel="stylesheet" href="../styles/rm_bud.css">
    <link rel="stylesheet" href="../styles/exp_inc.css">
    <title>Dashboard</title>
</head>
<body>
    <?php
        $current = 'income';
        include "../miscs/sidebar.php"; 
    ?>
   
   <section class="container">
        <div class="page_header">
            <div class="output_headers">
                <h1>Income</h1>
                <button class="create_new btns" id="btn_new">
                    <i class='bx bx-plus'></i>
                    <span>ADD NEW</span>
                </button>
            </div>
            <hr>
        </div>

        <div class="table-container">
            <table>
                <tr>
                    <th>Date</th>
                    <th>Origin</th>
                    <th>Type</th>
                    <th>Mode of Transaction</th>
                    <th>Amount</th>
                    <th>Remarks</th>
                    <th>Actions</th>
                
                </tr>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . date('m/d/Y', strtotime($row['inc_date'])) . "</td>";
                        echo "<td>" . $row['inc_origin'] . "</td>";
                        echo "<td>" . $row['inc_type'] . "</td>";
                        echo "<td>" . $row['inc_mot'] . "</td>";
                        echo "<td>" . $row['inc_amount'] . "</td>";
                        echo "<td>" . $row['inc_remarks'] . "</td>";
                        echo "<td>";
                        echo "<form method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='inc_id' value='" . $row['inc_id'] . "'>";
                        echo "<button type='submit' name='delete_income' class='action-btn delete' onclick='return confirm(\"Are you sure you want to delete this income?\")'>Delete</button>";
                        echo "</form>";
                        echo "<button class='action-btn'>Edit</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td>No incomes found.</td></tr>";
                }
                ?>
            </table>
        </div>
       <div class="table-container">
           <table>
               <tr class="tbl_headers">
                   <th>Date|Origin|Type|Mode of Transaction|Amount|Remarks|Actions</th>
               </tr>
               <?php
               if ($result && mysqli_num_rows($result) > 0) {
                   while ($row = mysqli_fetch_assoc($result)) {
                       echo "<tr>";
                       echo "<td>" . date('m/d/Y', strtotime($row['inc_date'])) ."|". $row['inc_origin'] ."|". $row['inc_type'] ."|". $row['inc_mot'] ."|". $row['inc_amount'] ."|". $row['inc_remarks'] ."|";
                       echo "<form method='post' style='display:inline;'>";
                       echo "<input type='hidden' name='inc_id' value='" . $row['inc_id'] . "'>";
                       echo "<button type='submit' name='delete_income' class='action-btn delete' onclick='return confirm(\"Are you sure you want to delete this income?\")'>Delete</button>";
                       echo "</form>";
                       echo "<button class='action-btn'>Edit</button>";
                       echo "</td>";
                       echo "</tr>";
                   }
               } else {
                   echo "<tr><td class='no_data'>No incomes found.</td></tr>";
               }
               ?>
           </table>
       </div>
   </section>

   <div class="modal-bg">
        <div class="modal-content">
            <div class="title">
                <h2>Add Income</h2>
                <i class='bx bx-x btn_cancel btn_c1'></i>
            </div>

            <form method="post">
                <div class="modal_field_rows">
                    <div class="modal_fields">
                        <label for="inc_type">Title: <b class="req_field">*</b></label>
                        <input type="text" name="inc_type" id="inc_type" required>
                    </div>
                </div>

                <div class="modal_field_rows">
                    <div class="modal_fields">
                        <label for="inc_date">Date: <b class="req_field">*</b></label>
                        <input type="date" name="inc_date" id="inc_date" required>
                    </div>

                    <div class="modal_fields">
                        <label for="inc_origin">Origin: <b class="req_field">*</b></label>
                        <input type="text" name="inc_origin" id="inc_origin" required>
                    </div>

                    <div class="modal_fields">
                        <label for="inc_mot">Mode of Transaction:</label>
                        <select name="inc_mot" id="inc_mot">
                            <option value="CASH">CASH</option>
                            <option value="GCASH">GCASH</option>
                            <option value="PAYMAYA">PAYMAYA</option>
                            <option value="BDO">BDO</option>
                            <option value="BPI">BPI</option>
                        </select>
                    </div>

                    <div class="modal_fields">
                        <label for="inc_amount">Amount: <b class="req_field">*</b></label>
                        <input type="number" name="inc_amount" id="inc_amount" min="0" step="0.01" required>
                    </div>
                </div>

                <div class="modal_field_rows">
                    <div class="modal_fields">
                        <label for="inc_remarks">Remarks:</label>
                        <textarea name="inc_remarks" id="inc_remarks"></textarea>
                    </div>
                </div>

                <div class="modal_field_rows modal_btns">
                    <input type="submit" name="add_income" value="ADD INCOME"  class="btn_modal">
                </div>
            </form>
        </div>
   </div>

   <script type="text/javascript" src="../scripts/modal.js"></script>
</body>
</html>
