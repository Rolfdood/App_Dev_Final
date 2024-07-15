<?php
session_start();
if (!isset($_SESSION['user_uname'])) {
    header('Location: ../backend/invalid_access.php');
} else {
    include '../backend/db_functions.php';
    $query = "SELECT * FROM user WHERE user_id = ?";
    $stmt = mysqli_prepare($db_connect, $query);
    $UID = $_SESSION['user_id'];
    mysqli_stmt_bind_param($stmt, 's', $UID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $username = $row['user_uname'];
    $fname = $row['user_fname'];
    $lname = $row['user_lname'];
    $email = $row['user_email'];
    $dob = $row['user_dob'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/user.css">
    <title>Profile</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php
    $current = 'profile';
    include "sidebar.php";
    ?>

    <!-- CONTAINER -->
    <section class="container">
        <div>
            <h1>Profile</h1>
            <hr>
        </div>
        <form method="post">
            <div>
                <h2>Profile Picture</h2>
                <span class="image">
                    <img src="../src/user_default.png" class="image" alt="logo">
                </span>
                <input type="submit" value="Edit" name="edit_pfp">
            </div>
            <div>
                <h2>Username</h2>
                <h3><?php echo $username ?></h3>
                <input type="submit" value="Edit" name="edit_uname">
            </div>
            <div>
                <h2>First Name</h2>
                <h3><?php echo $fname ?></h3>
                <input type="submit" value="Edit" name="edit_fname">
            </div>
            <div>
                <h2>Last Name</h2>
                <h3><?php echo $lname ?></h3>
                <input type="submit" value="Edit" name="edit_lname">
            </div>
            <div>
                <h2>Email Address</h2>
                <h3><?php echo $email ?></h3>
                <input type="submit" value="Edit" name="edit_email">
            </div>
            <div>
                <h2>Birth Date</h2>
                <h3><input type="date" value="<?php echo $dob ?>" <?php if (!isset($_POST['edit_dob'])) echo "readonly" ?>></h3>
                <input type="submit" value="Edit" name="edit_dob">
            </div>
        </form>
    </section>
</body>

</html>