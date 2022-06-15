<?php
include "connect.php";
session_start();

/* ====> Begin User Delete <==== */
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $page = $_GET['page'];
    $sql_delete = "DELETE FROM `register` WHERE `id` = '$user_id'";
    $sql_delete_run = mysqli_query($con, $sql_delete);
    if ($sql_delete_run) {
        $_SESSION['status'] = "! Successfully Deleted.";
        header("location: user_list.php?page=$page");
        exit();
    } else {
        $_SESSION['status'] = "! Something went wrong... Cannot not delete.";
        header("location: user_list.php?page=$page");
        exit();
    }
}
/* ====> End User Delete <==== */

/* ====> Begin Student Delete <==== */
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $page = $_GET['page'];
    $sql_delete = "DELETE FROM `students` WHERE `id` = '$student_id'";
    $sql_delete_run = mysqli_query($con, $sql_delete);
    if ($sql_delete_run) {
        $_SESSION['status'] = "! Successfully Deleted.";
        header("location: students_list.php?page=$page");
        exit();
    } else {
        // $_SESSION['status'] = "! Something went wrong... Cannot not delete.";
        $_SESSION['status'] = $con->error;
        header("location: students_list_list.php?page=$page");
        exit();
    }
}
/* ====> End Student Delete <==== */

