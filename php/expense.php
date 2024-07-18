<?php 
    session_start();
    include '../backend/db_conn.php'; 
    include '../backend/db_functions.php';

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); 
        exit();
    }

    if(!isset($_SESSION['user_uname'])){
        header('Location: ../backend/invalid_access.php');
    }
  
    // Handle expense addition
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_expense'])) {
        $exp_date = $_POST['exp_date'];
        $exp_type = $_POST['exp_type'];
        $exp_mop = $_POST['exp_mop'];
        $exp_amount = $_POST['exp_amount'];
        $exp_remarks = $_POST['exp_remarks'];
        $user_id = $_SESSION['user_id'];

        // Input validation (add more robust validation as needed)
        if (empty($exp_date) || empty($exp_type) || empty($exp_amount)) {
            echo "Please fill in all required fields.";
        } else {
            // Insert expense into database
            $sql = "INSERT INTO expenses (user_id, exp_date, exp_type, exp_mop, exp_amount, exp_remarks) 
                    VALUES ('$user_id', '$exp_date', '$exp_type', '$exp_mop', '$exp_amount', '$exp_remarks')";

            if (mysqli_query($db_connect, $sql)) {
                echo "Expense added successfully.";
            } else {
                echo "Error adding expense: " . mysqli_error($db_connect);
            }
        }
    }

    // Handle expense deletion
    if (isset($_POST['delete_expense'])) {
        $exp_id = $_POST['exp_id'];

        // Delete expense from database
        $sql = "DELETE FROM expenses WHERE exp_id = '$exp_id'";
        if (mysqli_query($db_connect, $sql)) {
            echo "Expense deleted successfully.";
        } else {
            echo "Error deleting expense: " . mysqli_error($db_connect);
        }
    }

    // Handle expense editing
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_expense'])) {
    $exp_id = $_POST['exp_id'];
    $exp_date = $_POST['exp_date'];
    $exp_type = $_POST['exp_type'];
    $exp_mop = $_POST['exp_mop'];
    $exp_amount = $_POST['exp_amount'];
    $exp_remarks = $_POST['exp_remarks'];

    // Input validation
    if (empty($exp_date) || empty($exp_type) || empty($exp_amount)) {
        echo "Please fill in all required fields.";
    } else {
        // Update expense in database
        $sql = "UPDATE expenses SET 
                exp_date = '$exp_date', 
                exp_type = '$exp_type', 
                exp_mop = '$exp_mop', 
                exp_amount = '$exp_amount', 
                exp_remarks = '$exp_remarks'
                WHERE exp_id = '$exp_id'";

        if (mysqli_query($db_connect, $sql)) {
            echo "Expense updated successfully.";
        } else {
            echo "Error updating expense: " . mysqli_error($db_connect);
        }
    }
}

// Fetch expenses for the current user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM expenses WHERE user_id = '$user_id'";
$result = mysqli_query($db_connect, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/assets/logo_colored.png" type="image/icon type">
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
        $current = 'expense';
        include "../miscs/sidebar.php";
    ?>

    <section class="container">
        <div class="page_header">
            <div class="output_headers">
                <h1>Expenses</h1>
                <button class="create_new btns" id="btn_new" onclick="openModal()">
                    <i class='bx bx-plus'></i>
                    <span>ADD NEW</span>
                </button>
            </div>
            <hr>
        </div>

        <div class="table-container">
            <table>
                <tr class="tbl_headers">
                    <th>Date</th>
                    <th>Type</th>
                    <th>Mode of Payment</th>
                    <th>Amount</th>
                    <th>Remarks</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . date('m/d/Y', strtotime($row['exp_date'])) . "</td>";
                        echo "<td>" . $row['exp_type'] . "</td>";
                        echo "<td>" . $row['exp_mop'] . "</td>";
                        echo "<td>" . number_format($row['exp_amount'], 2) . "</td>";
                        echo "<td>" . $row['exp_remarks'] . "</td>";
                        echo "<td>";
                        echo "<form method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='exp_id' value='" . $row['exp_id'] . "'>";
                        echo "<button type='submit' name='delete_expense' class='action-btn delete btn_act_del btn_act' onclick='return confirm(\"Are you sure you want to delete this expense?\")'>DELETE</button>";
                        echo "</form>";
                        echo "<button class='action-btn btn_act_edit btn_act' data-exp-id='" . $row['exp_id'] . "' onclick='openEditModal(" . $row['exp_id'] . ")'>EDIT</button>"; 
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='no_data'>No expenses found.</td></tr>";
                }
                ?>
            </table>
        </div>
    </section>

    <div class="modal-bg">
        <div class="modal-content">
            <div class="title">
                <h2>Add Expense</h2>
                <i class='bx bx-x btn_cancel btn_c1'></i>
            </div>

            <form method="post">
                <div class="modal_field_rows">
                    <div class="modal_fields">
                        <label for="exp_type">Item: <b class="req_field">*</b></label>
                        <input type="text" name="exp_type" id="exp_type" required>
                    </div>
                </div>

                <div class="modal_field_rows">
                    <div class="modal_fields">
                        <label for="exp_date">Date: <b class="req_field">*</b></label>
                        <input type="date" name="exp_date" id="exp_date" required>
                    </div>

                    <div class="modal_fields">
                        <label for="exp_mop">Mode of Payment:</label>
                        <select name="exp_mop" id="exp_mop">
                            <option value="CASH">CASH</option>
                            <option value="GCASH">GCASH</option>
                            <option value="PAYMAYA">PAYMAYA</option>
                            <option value="BDO">BDO</option>
                            <option value="BPI">BPI</option>
                        </select>
                    </div>

                    <div class="modal_fields">
                        <label for="exp_amount">Amount: <b class="req_field">*</b></label>
                        <input type="number" name="exp_amount" id="exp_amount" min="0" step="0.01" required>
                    </div>
                </div>

                <div class="modal_field_rows">
                    <div class="modal_fields">
                        <label for="exp_remarks">Remarks:</label>
                        <textarea name="exp_remarks" id="exp_remarks"></textarea>
                    </div>
                </div>
                

                <div class="modal_field_rows modal_btns">
                    <input type="submit" name="add_expense" value="ADD EXPENSE" class="btn_modal">
                </div>                
            </form>
        </div>
    </div>

    <div class="modal-bg" id="addModal"> </div>

    <div class="modal-bg" id="editModal">
        <div class="modal-content">
            <div class="title">
                <h2>Edit Expense</h2>
                <i class='bx bx-x btn_cancel_edit' onclick='closeEditModal()'></i> 
            </div>
            <form method="post" id="editForm">
                <input type="hidden" name="exp_id" id="editExpId">
                <div class="modal_field_rows">
                    <div class="modal_fields">
                        <label for="edit_exp_type">Item: <b class="req_field">*</b></label>
                        <input type="text" name="exp_type" id="edit_exp_type" required>
                    </div>
                </div>
                <div class="modal_field_rows">
                    <div class="modal_fields">
                        <label for="edit_exp_date">Date: <b class="req_field">*</b></label>
                        <input type="date" name="exp_date" id="edit_exp_date" required>
                    </div>
                    <div class="modal_fields">
                        <label for="edit_exp_mop">Mode of Payment:</label>
                        <select name="exp_mop" id="edit_exp_mop">
                            <option value="CASH">CASH</option>
                            <option value="GCASH">GCASH</option>
                            <option value="PAYMAYA">PAYMAYA</option>
                            <option value="BDO">BDO</option>
                            <option value="BPI">BPI</option>
                        </select>
                    </div>
                    <div class="modal_fields">
                        <label for="edit_exp_amount">Amount: <b class="req_field">*</b></label>
                        <input type="number" name="exp_amount" id="edit_exp_amount" min="0" step="0.01" required>
                    </div>
                </div>
                <div class="modal_field_rows">
                    <div class="modal_fields">
                        <label for="edit_exp_remarks">Remarks:</label>
                        <textarea name="exp_remarks" id="edit_exp_remarks"></textarea>
                    </div>
                </div>
                <div class="modal_field_rows modal_btns">
                    <input type="submit" name="edit_expense" value="UPDATE EXPENSE" class="btn_modal">
                </div>                
            </form>
        </div>
    </div>

    <script type="text/javascript" src="../scripts/modal.js"></script>
    <script>
        // Function to open the edit modal and populate it with expense data
        function openEditModal(expId) {
            // Fetch expense data using AJAX
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var expenseData = JSON.parse(this.responseText);
                    document.getElementById('editExpId').value = expenseData.exp_id;
                    document.getElementById('edit_exp_date').value = expenseData.exp_date;
                    document.getElementById('edit_exp_type').value = expenseData.exp_type;
                    document.getElementById('edit_exp_mop').value = expenseData.exp_mop;
                    document.getElementById('edit_exp_amount').value = expenseData.exp_amount;
                    document.getElementById('edit_exp_remarks').value = expenseData.exp_remarks;
                    document.getElementById('editModal').style.display = 'flex';
                }
            };
            xhttp.open("GET", "../backend/get_expense_data.php?exp_id=" + expId, true);
            xhttp.send();
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>

