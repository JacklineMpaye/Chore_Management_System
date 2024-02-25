<?php
// Include the connection file
include("../settings/connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_name = $_POST['user_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['Day'];
    $tel = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fid = mysqli_real_escape_string($con, $_POST['family_role']);
    echo "fid: " . $fid;

    // Encrypt the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Default role ID
    $rid = 3;

    // Determining the role ID based on the family role
    if ($fid == 1) {
        $rid = 1;
    } else if ($fid == 2) {
        $rid = 2;
    } else {
        $rid = 3;
    }

    // Write INSERT query using the variables above
    $query = "INSERT INTO People (rid, fid, gender, dob, tel, email, passwd, user_name) VALUES ('$rid', '$fid', '$gender', '$dob', '$tel', '$email', '$hashed_password', '$user_name')";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if execution was successful
    if ($result) {
        // Redirect based on role ID
        if ($rid == 1 || $rid == 2) {
            header("Location: ../view_folder/adminHomepage.html");
        } else {
            header("Location: ../view_folder/Home-Page.html");
        }
        exit; // Terminate script execution after redirection
    } else {
        // Display error message if execution failed
        echo "Error: " . mysqli_error($con);
    }
}

// Close the connection
mysqli_close($con);
?>
