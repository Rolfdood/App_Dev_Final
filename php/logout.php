<?php
// Start the session
session_start();

// Check if the user clicked the logout link
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Unset all of the session variables
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();

    // Redirect to login page or homepage
    header("Location: login.php"); // Change this to the page you want to redirect to
    exit;
} else {
    // If accessed directly, redirect to homepage or appropriate page
    header("Location: index.php"); // Change this to the page you want to redirect to
    exit;
}
?>
