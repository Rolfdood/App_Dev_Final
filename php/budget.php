<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../styles/general.css">
        <link rel="stylesheet" href="../styles/user.css">
        <title>Dashboard</title>
    </head>

    <body>
        <!-- NAVBAR -->
        <?php 
            $current = 'budget';
            include "sidebar.php"; 
        ?>

        <!-- CONTAINER -->
        <section class="container">
            <h1>Budget Plan</h1>
            <hr>
        </section>
    </body>
</html>