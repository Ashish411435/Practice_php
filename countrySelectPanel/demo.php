<?php

session_start();

require("db_connection.php");

if (isset($_SESSION['username']) == false) {
    header("location:login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h2><?php echo $_SESSION['username'] ?> </h2>

</body>

</html>