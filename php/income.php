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

    $current = 'income';
    include "sidebar.php";

    $database = [
        'name' => 'fintrack_db',
        'host' => 'localhost',
        'pass' => '',
        'user' => 'root'
    ];

    $db_connect = mysqli_connect($database['host'], $database['user'], $database['pass'], $database['name']);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    // Handle income addition
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_income'])) {
        $inc_date = $_POST['inc_date'];
        $inc_origin = $_POST['inc_origin'];
        $inc_type = $_POST['inc_type'];
        $inc_mot = $_POST['inc_mot'];
        $inc_amount = $_POST['inc_amount'];
        $inc_remarks = $_POST['inc_remarks'];
        $user_id = $_SESSION['user_id']; // Get user_id from session

        // Input validation 
        if (empty($inc_date) || empty($inc_origin) || empty($inc_amount)) {
            echo "Please fill in all required fields.";
        } else {
            // Insert income into database
            $sql = "INSERT INTO income (user_id, inc_date, inc_origin, inc_type, inc_mot, inc_amount, inc_remarks) 
                    VALUES ('$user_id', '$inc_date', '$inc_origin', '$inc_type', '$inc_mot', '$inc_amount', '$inc_remarks')";

            if (mysqli_query($db_connect, $sql)) {
                echo "Income added successfully.";
            } else {
                echo "Error adding income: " . mysqli_error($db_connect);
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
    $user_id = $_SESSION['user_id']; // Get user_id from session
    $sql = "SELECT * FROM income WHERE user_id = '$user_id' ORDER BY inc_date DESC"; // Order by date descending
    $result = mysqli_query($db_connect, $sql);
    ?>

    <section class="container">
        <h1>Income</h1>
        <hr>

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
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . date('m/d/Y', strtotime($row['inc_date'])) . "</td>"; // Format date
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
                ?>
            </table>
        </div>

        <h2>Add Income</h2>
        <form method="post">
            <label for="inc_date">Date:</label>
            <input type="date" name="inc_date" id="inc_date" required><br><br>

            <label for="inc_origin">Origin:</label>
            <input type="text" name="inc_origin" id="inc_origin" required><br><br>

            <label for="inc_type">Type:</label>
            <input type="text" name="inc_type" id="inc_type" required><br><br>

            <label for="inc_mot">Mode of Transaction:</label>
            <select name="inc_mot" id="inc_mot">
                <option value="GCASH">GCASH</option>
                <option value="PAYMAYA">PAYMAYA</option>
                <option value="BDO">BDO</option>
                <option value="BPI">BPI</option>
                <option value="CASH">CASH</option>
            </select><br><br>

            <label for="inc_amount">Amount:</label>
            <input type="number" name="inc_amount" id="inc_amount" min="0" step="0.01" required><br><br>

            <label for="inc_remarks">Remarks:</label>
            <textarea name="inc_remarks" id="inc_remarks"></textarea><br><br>

            <input type="submit" name="add_income" value="Add Income">
        </form>
    </section>
</body>

</html>
