<?php

$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "clothes";

$con = mysqli_connect("$hostname", "$username", "$password", "$db_name");

if($con)
{
    echo "Connection Successful";
}
else{
    echo "Connection Not Successful";
}

$sql = "INSERT INTO `brands` (Brand, price) VALUES ('Reebok', 2000);";
$sql = "DELETE FROM `brands` WHERE Brand = 'Puma'";
$sql = "UPDATE `brands` SET Brand = 'Addidas' WHERE Brand = 'Adidas'";
$sql = "SELECT * FROM `brands` WHERE id = 9";
$result = mysqli_query($con, $sql);
if($result)
{
    echo "Result Passed";
}
else{
    echo "Result Failed";
}

?>