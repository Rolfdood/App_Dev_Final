<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/user.css">
    <title>Dashboard</title>

    <style>
        /* Styling for the table container */
        .table-container {
            background-color: #333; /* Dark background */
            padding: 20px;
            border-radius: 10px; /* Rounded corners */
        }


        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }


        th, td {
            border: none; /* Remove default borders */
            padding: 12px 15px;
            text-align: left;
            color: white; /* White text */
        }


        th {
            background-color: #222; /* Slightly darker header */
            font-weight: bold;
        }


        tr:nth-child(even) {
            background-color: #444; /* Alternate row background */
        }


        /* Action button styling */
        .action-btn {
            background-color: #007bff; /* Blue */
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none; /* Remove underline from links */
        }


        .action-btn.delete {
            background-color: #dc3545; /* Red */
        }


        /* Hover effect for buttons */
        .action-btn:hover {
            opacity: 0.8;
        }

    </style>
</head>
<body>
    <?php
    session_start();
    /*
    // Check if the user is logged in
    /*if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); // Redirect to login if not logged in
        exit();

    }*/

    include '../backend/db_functions.php';
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

    // Fetch expenses for the current user
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM income WHERE user_id = '$user_id'";
    $result = mysqli_query($db_connect, $sql);

    $current = 'expense';
    include "sidebar.php";

    ?>

    <section class="container">
        <h1>Expenses</h1>
        <hr>

        <div class="table-container">
            <table>
                <tr>
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
                        echo "<td>" . $row['exp_amount'] . "</td>";
                        echo "<td>" . $row['exp_remarks'] . "</td>";
                        echo "<td>";
                        echo "<form method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='exp_id' value='" . $row['exp_id'] . "'>";
                        echo "<button type='submit' name='delete_expense' class='action-btn delete' onclick='return confirm(\"Are you sure you want to delete this expense?\")'>Delete</button>";
                        echo "</form>";
                        echo "<button class='action-btn'>Edit</button>"; // (Edit functionality not implemented yet)
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No expenses found.</td></tr>";
                }
                ?>
            </table>
        </div>

        <h2>Add Expense</h2>
        <form method="post">
            <label for="exp_date">Date:</label>
            <input type="date" name="exp_date" id="exp_date" required><br><br>

            <label for="exp_type">Type:</label>
            <input type="text" name="exp_type" id="exp_type" required><br><br>

            <label for="exp_mop">Mode of Payment:</label>
            <select name="exp_mop" id="exp_mop">
                <option value="GCASH">GCASH</option>
                <option value="PAYMAYA">PAYMAYA</option>
                <option value="BDO">BDO</option>
                <option value="BPI">BPI</option>
                <option value="CASH">CASH</option>
            </select><br><br>

            <label for="exp_amount">Amount:</label>
            <input type="number" name="exp_amount" id="exp_amount" min="0" step="0.01" required><br><br>

            <label for="exp_remarks">Remarks:</label>
            <textarea name="exp_remarks" id="exp_remarks"></textarea><br><br>

            <input type="submit" name="add_expense" value="Add Expense">
        </form>
    </section>
</body>
</html>
