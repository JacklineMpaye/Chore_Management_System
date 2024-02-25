<?php
// Include the database connection file
include("../settings/connection.php");

// Check if the connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to select all roles from the Family_name table
$query = "SELECT fid, fam_name FROM Family_name"; // Assuming 'role' is the correct column name

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query executed successfully
if ($result) {
    // Fetch all rows from the result set
    $roles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    
    // Check if any roles were returned
    if (empty($roles)) {
        die("No roles found."); // If no roles found, terminate script
    }

    // Build the family role dropdown on the register_view page
    // Build the family role dropdown on the register_view page
    echo "<select name='family_role'>";
   
    // Loop through the family roles retrieved from the database
    foreach ($roles as $role) {
        // Display each family role as an option with the fid as the value
        echo "<option value='" . $role['fid'] . "'>" . $role['fam_name'] . "</option>";
    }
   
    echo "</select>";

    
    // Free result set
    mysqli_free_result($result);
} else {
    // If query execution fails, display error message
    echo "Error: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
