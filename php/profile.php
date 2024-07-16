<?php include '../backend/profile_backend.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/user.css">
    <link rel="stylesheet" href="../styles/profile.css">
    <title>Profile</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php
    $current = 'profile';
    include "../miscs/sidebar.php"; 
    ?>

    <!-- CONTAINER -->
    <section class="container">
        <div>
            <h1>Profile</h1>
            <hr>
        </div>
        <form method="post" class="profile">
            <div class="profile_pic">
                <span class="image">
                    <img src="../src/user_default.png" class="image" alt="logo">
                </span>
            </div>

            <div class="inputFields">
                <div class="inpFields">
                    <h2>Username</h2>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" <?php echo !$edit_uname ? "readonly" : ""; ?>>
                    <?php if ($edit_uname) : ?>
                        <input type="submit" value="Save" name="save_uname">
                        <input type="submit" class="btn_cancel" value="Cancel" name="cancel_uname">
                    <?php else : ?>
                        <input type="submit" value="Edit" name="edit_uname">
                    <?php endif; ?>
                    <?php if ($error['uname']) : ?>
                        <div class="error-message">Invalid username format.</div>
                    <?php endif; ?>
                </div>

                <div class="inpFields">
                    <h2>First Name</h2>
                    <input type="text" name="fname" value="<?php echo htmlspecialchars($fname); ?>" <?php echo !$edit_fname ? "readonly" : ""; ?>>
                    <?php if ($edit_fname) : ?>
                        <input type="submit" value="Save" name="save_fname">
                        <input type="submit" class="btn_cancel" value="Cancel" name="cancel_fname">
                    <?php else : ?>
                        <input type="submit" value="Edit" name="edit_fname">
                    <?php endif; ?>
                    <?php if ($error['fname']) : ?>
                        <div class="error-message">Invalid first name format.</div>
                    <?php endif; ?>
                </div>
              
                <div class="inpFields">
                    <h2>Last Name</h2>
                    <input type="text" name="lname" value="<?php echo htmlspecialchars($lname); ?>" <?php echo !$edit_lname ? "readonly" : ""; ?>>
                    <?php if ($edit_lname) : ?>
                        <input type="submit" value="Save" name="save_lname">
                        <input type="submit" class="btn_cancel" value="Cancel" name="cancel_lname">
                    <?php else : ?>
                        <input type="submit" value="Edit" name="edit_lname">
                    <?php endif; ?>
                    <?php if ($error['lname']) : ?>
                        <div class="error-message">Invalid last name format.</div>
                    <?php endif; ?>
                </div>
              
                <div class="inpFields">
                    <h2>Email Address</h2>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" <?php echo !$edit_email ? "readonly" : ""; ?>>
                    <?php if ($edit_email) : ?>
                        <input type="submit" value="Save" name="save_email">
                        <input type="submit" class="btn_cancel" value="Cancel" name="cancel_email">
                    <?php else : ?>
                        <input type="submit" value="Edit" name="edit_email">
                    <?php endif; ?>
                    <?php if ($error['email']) : ?>
                        <div class="error-message">Invalid email format.</div>
                    <?php endif; ?>
                </div>

                <div class="inpFields">
                    <h2>Birth Date</h2>
                    <input type="date" name="dob" value="<?php echo htmlspecialchars($dob); ?>" <?php echo !$edit_dob ? "readonly" : ""; ?>>
                    <?php if ($edit_dob) : ?>
                        <input type="submit" value="Save" name="save_dob">
                        <input type="submit" class="btn_cancel" value="Cancel" name="cancel_dob">
                    <?php else : ?>
                        <input type="submit" value="Edit" name="edit_dob">
                    <?php endif; ?>
                </div>
                <div class="inpFields password">
                    <h2>Change Password</h2>
                    <?php if ($edit_password) : ?>
                        <div class="password_fields">
                            <input type="password" name="new_password" placeholder="New Password">
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </div>

                        <input type="submit" value="Save" name="save_password">
                        <input type="submit" class="btn_cancel" value="Cancel" name="cancel_password">
                    <?php else : ?>
                        <input type="password" value="********" readonly>
                        <input type="submit" value="Edit" name="edit_password">
                    <?php endif; ?>
                    <?php if ($error['password']) : ?>
                        <div class="error-message">Invalid password format.</div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </section>
</body>

</html>