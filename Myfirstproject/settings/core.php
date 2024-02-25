<?php
session_start();

function check_login() {
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        header("Location: ../Login/Log-in_view.php");
        die(); // Terminate script execution after redirection
    }
}

?>
