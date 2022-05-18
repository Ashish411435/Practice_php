<?php

$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "test_login";

// Connection
$con = mysqli_connect("$hostname", "$username", "$password", "$db_name");
if ($con) {
    // echo "Success Connection";
} else {
    // echo "Connection Failed";
}

?>