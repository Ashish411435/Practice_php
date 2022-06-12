<?php
session_start();
// Check Login Existence
if (isset($_SESSION['email']) == false) {
    $_SESSION['status'] = "! Something went wrong...Please Login Again.";
    header("location:login.php");
    exit();
}
if (isset($_SESSION['usertype'])) {
    $usertype = $_SESSION['usertype'];
    if ($usertype != "admin") {
        $_SESSION['status'] = "! Something went wrong...Please Login Again.";
        header("location:login.php");
        exit();
    }
}

// Database connection
include "connect.php";
// Sidebar
include "sidebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="main_content_css.css">
    <title>Document</title>
</head>

<body>
    <div class="main_content">
        <?php
        require_once "navbar.php";
        ?>




        <?php
        if (isset($_SESSION['status']) == true) {
            echo '<div class="alert">' . $_SESSION['status'] . '</div>';
            unset($_SESSION['status']);
        }
        ?>
        <div class="adding_forms">
            <h2 style="color: #4968a7;">Admin Dashboard</h2>
            <h2 style="color: #4968a7;">Welcome <?= $_SESSION['email'] ?></h2>
        </div>
    </div>
</body>

</html>