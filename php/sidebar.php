<nav class="sidebar close">
    <header> 
        <div class="image-text">
            <span class="image">
                <img src="../src/user_default.png" alt="logo">
            </span>

            <div class="text header-text">
                <!-- INPUT!!! -->
                 <!-- USE SESSION -->
                <span class="uname">TEST 1</span>
                <span class="userID">UID: 0000000001</span>
            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i>
    </header>

    <hr>

    <div class="menu-bar">
        <div class="menu">
            <li class="search-box">
                    <i class='bx bx-search icon'></i>                           
                    <input type="sear   ch" name="" id="" placeholder="SEARCH">
            </li>
            <ul class="menu-links">
                <li class="nav-link" <?php if ($current == 'dashboard') echo 'id="current"'; ?>>
                    <a href="dashboard.php" id="">
                        <i class='bx bxs-dashboard icon' ></i>
                        <span class="text nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-link" <?php if ($current == 'profile') echo 'id="current"'; ?>>
                    <a href="profile.php" id="">
                        <i class='bx bxs-user icon' ></i>
                        <span class="text nav-text">Profile</span>
                    </a>
                </li>
                <li class="nav-link" <?php if ($current == 'expense') echo 'id="current"'; ?>>
                    <a href="expense.php" id="">
                        <i class='bx bxs-credit-card-alt icon' ></i>
                        <span class="text nav-text">Expenses</span>
                    </a>
                </li>
                <li class="nav-link" <?php if ($current == 'income') echo 'id="current"'; ?>>
                    <a href="income.php" id="">
                        <i class='bx bxs-coin icon' ></i>
                        <span class="text nav-text">Income</span>
                    </a>
                </li>
                <li class="nav-link" <?php if ($current == 'summary') echo 'id="current"'; ?>>
                    <a href="summary.php" id="">
                        <i class='bx bxs-bar-chart-alt-2 icon' ></i>
                        <span class="text nav-text">Summary</span>
                    </a>
                </li>
                <li class="nav-link" <?php if ($current == 'budget') echo 'id="current"'; ?>>
                    <a href="budget.php" id="">
                        <i class='bx bxs-note icon' ></i>
                        <span class="text nav-text">Budget Plan</span>
                    </a>
                </li>
                <li class="nav-link" <?php if ($current == 'rmshare') echo 'id="current"'; ?>>
                    <a href="share.php" id="">
                        <i class='bx bxs-home-circle icon' ></i>
                        <span class="text nav-text">Room Share</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="bottom-content">
            <li class="nav-link">
                <a href="#" id="">
                    <i class='bx bxs-log-out icon' ></i>
                    <span class="text nav-text">Log Out</span>
                </a>
            </li>
        </div>
    </div>
    
    <script src="../scripts/sidebar.js"></script>
</nav>