<?php
include("../settings/connection.php");
include("../settings/functions.php");
include("../settings/core.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($_user_name) && !empty($password) && !is_numeric($_user_name)) {
        $user_id = random_num(20);
        $query = "INSERT INTO login (user_id, user_name, password) VALUES ('$user_id', '$_user_name', '$password') ";

        mysqli_query($con, $query);

        header("Location: ../view_folder/Home-Page.html");
        die;
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
    <link rel="stylesheet" type="text/css" href="../CSS/Sign-up.css">
    <title>Sign up page</title>
</head>

<body>
    <div class="container">
        <h1>Sign up to Chores MS</h1>
        
        <form  action="../action/register_user_action.php" method="post" onsubmit="return validateForm()">
            <label for="user_name">User Name</label>
            <input type="text" id="user_name" name="user_name" required><br>

            <label for="gender">Gender</label>
            <input type="radio" id="male" name="gender" value="male" required><br>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" required><br>
            <label for="female">Female</label>

            <label for="familyrole">Family Role</label>
            <?php include "../functions/select_role_fxn.php"; ?><br>
            <label for="dob">Date of Birth</label>
            <div style="display: flex;">
                <select id="month" name="month" required>
                    <option value="" disabled selected>Month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <input type="number" id="Day" name="Day" placeholder="Day" required><br>
                <input type="number" id="year" name="year" placeholder="Year" required><br>
            </div>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="e.g., +1234567890" required><br>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required><br>

            <label for="confirmpassword">Confirm Password</label>
            <input type="password" id="confirmpassword" name="confirmpassword" required><br>

            <!--<input type="submit" id="button" value="Sign up" name="submit"><br>-->
            <input type="submit" id="button" value="Sign up"></input>
        </form>
        <p>Already have an account? <a href="../Login/Log-in_view.php">Login</a></p>
    </div>

    <script>
        function validateForm() {
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmpassword").value;

        const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;

        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address");
            return false;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match");
            return false;
        }

        // If validation succeeds, redirect to homepage
        redirectToHomePage();
        return true;
    }

    function redirectToHomePage() {
        window.location.href = "../view_folder/Home-Page.html";
    }
    </script>
</body>

</html>
