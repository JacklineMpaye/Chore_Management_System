<?php
session_start();

include("../settings/connection.php");
require_once("../settings/functions.php"); // Use require_once instead of include

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    // Check if the user is logged in
    $user_data = check_login($con); // Call check_login function from functions.php

    if ($user_data !== null && isset($user_data['user_name'])) {
        // Proceed with accessing $user_data['user_name'] or performing other operations
        // For example, you might display a welcome message using the user's name:
        $welcome_message = "Welcome back, " . $user_data['user_name'] . "!";
    } else {
        // Handle the case when user is not logged in
        // For example, you might redirect the user to the login page:
        header("Location: ../Login/Log-in_view.php");
        exit(); // Terminate script execution after redirection
    }

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Read from database
        $query = "SELECT * FROM login WHERE user_name = '$user_name' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            $user_data = mysqli_fetch_assoc($result);
            if (password_verify($password, $user_data['password'])) {
                $_SESSION['user_name'] = $user_data['user_name'];
                $_SESSION['user_id'] = $user_data['user_id'];
                // Set other session variables as needed
                header("Location: Home-Page.html");
                exit; // Exit after redirection to prevent further execution
            } else {
                echo "Invalid password";
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Please enter some valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ADD8E6; /* Light blue background color */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            height: 100vh; /* Full height of viewport */
        }

        #form {
            background-color: white;
            width: 40%;
            padding: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
        }

        input {
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%; /* Make inputs full width */
        }

        #btn {
            background-color: #71ccf0;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%; /* Make button full width */
        }

        #error-message {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 2px solid red;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
        }

        button:hover {
            background-color: #f7668a;
        }

        label {
            margin-bottom: 8px;
        }

        p {
            margin-top: 15px;
            font-size: 14px;
        }

        a {
            color: #e22f89;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .message {
            text-align: center; /* Center the message */
        }

        * {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="error-message">Invalid username or password</div>
    <div id="form">
        <form method="post" name="form", action ="../action/login_user_action.php">
            <h1>Login to Chores MS</h1>

            <label for="username">Username or Email</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" id="btn" value="Login" name="submit">

            <p>Don't have an account? <a href="../Login/Register_view.php">Sign-up</a></p>
        </form>
    </div>

    <script>
        // Check if there's a parameter in the URL indicating login failure
        const urlParams = new URLSearchParams(window.location.search);
        const loginFailed = urlParams.has('login_failed');

        // If login failed, show the error message
        if (loginFailed) {
            document.getElementById('error-message').style.display = 'block';
        }
    </script>
</body>

</html>
