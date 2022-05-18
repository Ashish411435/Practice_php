<?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db_name = "bcm";


    $con = mysqli_connect("$hostname", "$username", "$password", "$db_name");

    // To check connection in working
    if($con)
    {
        echo "Connection Successful";
    }
    else{
        echo "Connection Unsuccessful";
    }

    $sql = "INSERT INTO `students` (name, city, gender, rating) VALUES ('Gurinder', 'Ludhiana', 'Male', 5);";
    $sql = "DELETE FROM `students` WHERE id = 14";
    $sql = "UPDATE `students` SET name = 'Ashish' WHERE name = 'Ashish Choudhary'";
    $sql = "SELECT * FROM `students` WHERE gender = 'female'";

    $result = mysqli_query($con, $sql);    
    if($result)
    {
        echo "Result Successful";
    }
    else{
        echo "Result Unsuccessful";
    }
    

?>