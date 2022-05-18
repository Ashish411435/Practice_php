<?php

$serverName = "localhost";
$username = "root";
$password = "";
$database = "clothes";

$conn = mysqli_connect($serverName, $username, $password, $database);

if($conn)
{
    echo "Success";
}
else{
    echo "Not Success";
}


$sql = "INSERT INTO `brands` (`Brand`, `price`) VALUES ('Gucci', '2000Rs /-');";

$result = mysqli_query($conn, $sql);
if($result)
{
    echo "Result Success";
}
else{
    echo "Result Not Success";   
}

?>