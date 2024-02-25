<?php
session_start();



include( "../settings/connection.php");
include( "../settings/functions.php" );
include("../settings/core.php");

$user_data = check_login($con);





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chore_MGT</title>
</head>
<body>
    <a href = "../Login/Logout_view.php">Logout</a>

    Hello, <?php echo $user_data['user_name']; ?>
</body>
</html>