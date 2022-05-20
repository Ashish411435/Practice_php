<?php

    // setcookie("name of cookie", "value of cookie", expiry time for cookie)
    setcookie("name", "ashish", time() + 3600);
    if(isset($_COOKIE['name'])){
        echo "cookie saved <br>";
    }
    else{
        echo "Not Saved <br>" ;
    }
    session_start();

    $_SESSION['email'] = "ash@gmail.com";
    if(isset($_SESSION['email'])){
        echo "yes   " . $_SESSION['email'] . "<br>";
    }else{
        echo 'No' . $_SESSION['email'] ."<br>";
    }
    // session_destroy();
   echo session_status();
    // echo session_abort();
    echo session_reset();
