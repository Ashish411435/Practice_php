<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db_name = "student_regis";

    $con = mysqli_connect($hostname, $username, $password, $db_name);
    
    if(!$con){
        $con_error = mysqli_connect_error();
        echo "Connection error because of this error ---> $con_error" ;
    }

    