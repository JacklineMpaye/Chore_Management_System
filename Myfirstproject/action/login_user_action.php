<?php
// Start session using PHP session method
session_start();

// Include the connection file
include("../settings/connection.php");

// Check if login button was clicked
if (isset($_POST['login'])) {
    // Collect form data and store in variables
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Write a query to SELECT a record from the people table using the email
    $query = "SELECT * FROM People WHERE email = '$email'";

    $result = mysqli_query($con, $query);

    
    if (mysqli_num_rows($result) == 1) {
        // Fetch the record
        $user = mysqli_fetch_assoc($result);

        // Verify password user provided against database record using password_verify()
        if (password_verify($password, $user['passwd'])) {
            // Create a session for user id and role id
            $_SESSION['user_id'] = $user['pid'];
            $_SESSION['role_id'] = $user['rid'];

            // Redirect to home page
            header("Location:../view_folder/Home-Page.html");
            exit();
        } else {
            echo "Incorrect username or password.";
        }
    } else {
       
        echo "User not registered or incorrect username.";
    
    }
} else {
    echo "Invalid request.";
}


mysqli_close($con);
?>
