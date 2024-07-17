<?php 
  /*session_start();
  if(isset($_SESSION['user_uname'])) {
    header('Location: php/dashboard.php');
  }*/
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="src/assets/logo_colored.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <title>SoloSpend</title>
  </head>

  <body>
    <nav class="navbar">
      <div class="logo">
        <img src="src/assets/logo_colored.png" alt="logo">
        <span class="app-name">SoloSpend</span>
      </div>

      <div class="nav-buttons">
        <ul>
          <li class="nav-link">
            <a href="#home">
              <i class='bx bxs-home icon'></i>
              <span class="text">HOME</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#about">
              <i class='bx bxs-info-circle icon' ></i>
              <span class="text">ABOUT</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#contact">
              <i class='bx bxs-phone icon' ></i>
              <span class="text">CONTACT</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="php/login.php">
              <i class='bx bxs-user icon' ></i>
              <span class="text">LOGIN</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="php/register.php">
              <i class='bx bxs-user-plus icon' ></i>
              <span class="text">REGISTER</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <section class="header" id="home">
      <div class="header-contents">
        <img src="src/assets/logo_light.png" alt="logo">
        <div class="header-text">
          <span class="header-app-name">SoloSpend</span>
          <hr>
          <span class="tagline">Where Independence Meets Expense Tracking</span>
        </div>
      </div>
    </section>

    <section class="about" id="about">
      <!-- INSERT INFO ABOUT THE APP & GROUP -->
      <div class="main_about">
        <div class="text">
          <div class="about-text main-about-text">
            <h2>About</h2>
            <p>SoloSpend is a user-friendly application designed to assist individuals, especially students living independently, in tracking and managing their finances. The goal is to help users maximize their limited allowances by providing comprehensive tools for monitoring income and expenses.</p>
          </div>

          <div class="about-text additionals">
            <h3>Why choose SoloSpend?</h3>
            <p>SoloSpend empowers students and individuals living alone by providing the tools needed to achieve financial stability. By offering a clear and intuitive interface for managing expenses and budgets, SoloSpend helps users save money and manage their finances more effectively.</p>
          </div>
        </div>

        <div class="image">
          <img src="src/assets/about.png" alt="img">
        </div>
      </div>
    </section>

    <section class="advantages">
      <div class="benefits-header">
        <div class="image">
            <img src="src/assets/about2.png" alt="img">
            <h4>Benefits</h4>
          </div>

        <div class="benefits right">
          <div class="benefit-item">
            <h4>Financial Awareness</h4>
            <p>
              SoloSpend helps users gain a clear understanding of their spending habits by providing detailed expense summaries. This awareness is crucial for making informed financial decisions and avoiding unnecessary expenditures.
            </p>
          </div>

          <div class="benefit-item">
            <h4>User-Friendly Interface</h4>
            <p>
              SoloSpend is designed with a simple and intuitive interface, making it easy for anyone to navigate and manage their finances without hassle.</p>
          </div>

          <div class="benefit-item">
            <h4>Secure and Private</h4>
            <p>
              The application ensures the security and privacy of user data, providing peace of mind that personal financial information is protected.
            </p>
          </div>

          <div class="benefit-item">
            <h4>Accessibility</h4>
            <p>
              Being a web-based tool, SoloSpend is accessible from anywhere, at any time. This convenience allows users to manage their finances on the go.
            </p>
          </div>

          <div class="benefit-item">
            <h4>Budget Management</h4>
            <p>
              Users can easily set up and allocate budgets for different categories, ensuring they stay within their financial limits. This feature helps in planning ahead and avoiding overspending.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="contact" id="contact">
      <!-- INSERT CONTACT INFORMATION -->
       <div class="contacts_left">
          <h4>Contact Us</h4>
          <span>
            <i class='bx bxs-envelope' ></i>
            support@solospend.com
          </span>

          <span>
            <i class='bx bxs-phone'></i>
            +1 (555) 123-4567
          </span>
       </div>

       <div class="contacts_right">
          <span class="footer">SoloSpend 2024.</span>
       </div>
    </section>
  </body>

</html>