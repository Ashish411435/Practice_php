<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "spinowheel";

// Connection
$con = mysqli_connect("$hostname", "$username", "$password", "$db_name");
if (!$con) {
    echo mysqli_connect_error();
}

?>