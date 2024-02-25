<?php
// Start session
session_start();


unset($_SESSION['user_id']);
unset($_SESSION['role_id']);


header("Location: ../Login/login_view.php");


exit();
?>
