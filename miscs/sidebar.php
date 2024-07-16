<?php
    include("../backend/sidebar_backend.php");
?>

<nav class="sidebar">
    <header> 
        <div class="image-text">
            <span class="image">
                <img src="../src/user_default.png" alt="logo">
            </span>

            <div class="text header-text">
                <!-- INPUT!!! -->
                 <!-- USE SESSION -->
                 <span class="uname"><?php echo $_SESSION['user_uname']?></span>
                 <span class="userID">UID: <?php print_UID($_SESSION['user_id'])?></span>
            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <hr>

    <div class="menu-bar">
        <div class="menu">
            <!-- TO BE IMPLEMENTED SOON
            <li class="search-box">
                    <i class='bx bx-search icon'></i>                           
                    <input type="sear   ch" name="" id="" placeholder="SEARCH">
            </li> -->
            <ul class="menu-links">
                <li class="nav-link" <?php if ($current == 'dashboard') echo 'id="current"'; ?>>
                    <a href="../php/dashboard.php" id="" title="Dashboard">
                        <i class='bx bxs-dashboard icon' ></i>
                        <span class="text nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-link" <?php if ($current == 'profile') echo 'id="current"'; ?>>
                    <a href="../php/profile.php" id="" title="Profile">
                        <i class='bx bxs-user icon' ></i>
                        <span class="text nav-text">Profile</span>
                    </a>
                </li>
                <li class="nav-link" <?php if ($current == 'expense') echo 'id="current"'; ?>>
                    <a href="../php/expense.php" id="" title="Expenses">
                        <i class='bx bxs-credit-card-alt icon' ></i>
                        <span class="text nav-text">Expenses</span>
                    </a>
                </li>
                <li class="nav-link" <?php if ($current == 'income') echo 'id="current"'; ?>>
                    <a href="../php/income.php" id="" title="Income">
                        <i class='bx bxs-coin icon' ></i>
                        <span class="text nav-text">Income</span>
                    </a>
                </li>
                <li class="nav-link" <?php if ($current == 'summary') echo 'id="current"'; ?>>
                    <a href="summary.php" id="" title="Summary">
                        <i class='bx bxs-bar-chart-alt-2 icon' ></i>
                        <span class="text nav-text">Summary</span>
                    </a>
                </li> 
                <li class="nav-link" <?php if ($current == 'budget') echo 'id="current"'; ?>>
                    <a href="../php/budget.php" id="" title="Budget Plan">
                        <i class='bx bxs-note icon' ></i>
                        <span class="text nav-text">Budget Plan</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="bottom-content">
            <li class="nav-link logout">
                <a href="../php/logout.php" id="" title="Log out">
                    <i class='bx bxs-log-out icon' ></i>
                    <span class="text nav-text">Log Out</span>
                </a>
            </li>
            <hr>
            <li class="nav-link">
                <img src="../src/logo_light.png" class="icon logo" alt="">
                <span class="text nav-text">SoloSpend</span>
            </li>

            <?php
                //if (isset($_REQUEST['log_out'])) {
                //    session_unset();
                //}
            ?>
        </div>
    </div>
    
    <script src="../scripts/sidebar.js"></script>
</nav>