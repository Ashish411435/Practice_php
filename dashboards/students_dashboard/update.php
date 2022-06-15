<?php
include "connect.php";

/* ===============> Begin Update User Form <=============== */
if (isset($_POST['user_update'])) {
    $user_id = $_POST['userid'];
    $usertype = $_POST['usertype'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];

    $sql_update = "UPDATE `register` SET `name` = '$username', `gender` = '$gender', `email` = '$email', `mobile` = '$mobile', `user_type` = '$usertype', `status` = '$status' WHERE `id` = $user_id";
    // die();
    $sql_update_run = mysqli_query($con, $sql_update);
    if ($sql_update_run) {
        $_SESSION['status'] = "Successfully Updated.";
        header("location: user_list.php");
        exit();
    } else {
        $_SESSION['status'] = mysqli_connect_error();
        header("location: user_list.php");
        exit();
    }
}
/* ===============> End Update User Form <=============== */
?>