<?php
$servername = "localhost";
$username ="root";
$password ="";
$db_name = "chores_mgt";
$con = new mysqli($servername, $username, $password, $db_name, 3306);
if($con-> connect_error){
    die("Connection failed".$con->connect_error);
    }
    //echo "Connection Succesful";

?>