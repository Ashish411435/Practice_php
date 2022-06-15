<?php
// Database connection
include "connect.php";

session_start();

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

    <style>
        .main_content .adding_forms {
            height: 100vh;
            position: unset;
            /* padding: 10px; */
        }

        .main_content .adding_forms .card {
            width: 100%;
            height: 100%;
            position: unset;
            transform: translate(0, 0);
            padding: 5px 40px;
        }

        .main_content .card .card-body {
            display: grid;
        }

        .main_content .card .card-body .card-title {
            padding-top: 25px;
            color: #435e9b;
            font-size: 22px;
            margin-bottom: 0px;
        }


        .btns_c {
            padding: 20px 40px;
        }

        .addcat_btn,
        .catlist_btn {
            padding: 10px 20px;
            border-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            border-radius: 20px;
            border: none;
            background: linear-gradient(to right, #1f3b73, #7390db);
            color: white;
            font-size: 15px;
            transition: all 0.5s ease;
        }

        .addcat_btn:hover,
        .catlist_btn:hover {
            background: #809bdc;
            background: -webkit-linear-gradient(to right, #294378, #617dbe);
            background: linear-gradient(to right, #8ba9f4, #1f3b73);
            box-shadow: inset 3px 0px 0.5px 1px;
        }

        .addcat_btn.active,
        .catlist_btn.active {
            background: #809bdc;
            background: -webkit-linear-gradient(to right, #294378, #617dbe);
            background: linear-gradient(to right, #9ab2e9, #23458a);
            box-shadow: inset 3px 0px 0.5px 1px;
            transform: scale(1.5);
            padding: 9px 18px;
            border-radius: 20px;
        }
    </style>
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
            <div class="btns_c">
                <a href="add_student.php" class="btns addcat_btn">Add Student</a>
                <a href="students_list.php" class="btns active catlist_btn">Students List</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">---Student List---</h2>
                    <?php
                    if (isset($_SESSION['email'])) {
                    ?>
                        <?php
                        if (isset($_SESSION['usertype'])) {
                            $usertype = $_SESSION['usertype'];
                            // echo $usertype;
                            if ($usertype == "admin") {
                        ?>
                                <table class="styled-table">
                                    <thead>
                                        <tr>
                                            <th>User Id</th>
                                            <th>User Type</th>
                                            <th>Student Id</th>
                                            <th>Student Name</th>
                                            <th>Father Name</th>
                                            <th>Gender</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Join Date</th>
                                            <th>End Date</th>
                                            <th>Duration</th>
                                            <th>Update</th>
                                            <th>Delete</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $record_per_page = 7;
                                        if (isset($_GET['page'])) {
                                            $page = $_GET['page'];
                                        } else {
                                            $page = 1;
                                        }

                                        $offset_value = ($page - 1) * $record_per_page;

                                        $sql_fetch = "SELECT * FROM `students` ORDER BY `student_name` ASC LIMIT {$offset_value}, {$record_per_page}";
                                        $sql_fetch_run = mysqli_query($con, $sql_fetch);
                                        if (mysqli_num_rows($sql_fetch_run) > 0) {
                                            while ($row = mysqli_fetch_assoc($sql_fetch_run)) {
                                                $student_id = $row['id'];
                                                $user_id = $row['user_id'];
                                                $user_type = $row['user_type'];
                                                $student_name = $row['student_name'];
                                                $father_name = $row['father_name'];
                                                $gender = $row['gender'];
                                                $mobile = $row['mobile'];
                                                $email = $row['email'];
                                                $address = $row['address'];
                                                $join_date = $row['join_date'];
                                                $end_date = $row['end_date'];
                                                $duration = $row['duration'];
                                                echo '<tr>
                                            <td>' . $user_id . '</td>
                                            <td>' . $user_type . '</td>
                                        <td>' . $student_id . '</td>
                                        <td>' . $student_name . '</td>
                                        <td>' . $father_name . '</td>
                                        <td>' . $gender . '</td>
                                        <td>' . $mobile . '</td>
                                        <td>' . $email . '</td>
                                        <td>' . $address . '</td>
                                        <td>' . $join_date . '</td>
                                        <td>' . $end_date . '</td>
                                        <td>' . $duration . '</td>
                                        <td><a class="edit_btn" href="students_edit.php?student_id=' . $student_id . '&page=' . $page . '">Edit</a></td>
                                        <td><a class="delete_btn" href="delete.php?student_id=' . $student_id . '&page=' . $page . '">Delete</a></td>
                                    </tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- Pagination Begin -->
                                <?php
                                $sql_pagination = "SELECT * FROM `students`";
                                $sql_pagination_run = mysqli_query($con, $sql_pagination);
                                if (mysqli_num_rows($sql_pagination_run) > 0) {
                                    $total_record = mysqli_num_rows($sql_pagination_run);
                                    $total_pages = ceil($total_record / $record_per_page);
                                ?>
                                <?php
                                    echo '<nav class="pagination">';
                                    echo  '<ul>';
                                    if ($page > 1) {
                                        echo  '<li><a href="students_list.php?page=' . ($page - 1) . '">Previous</a></li>';
                                    }
                                    for ($i = 1; $i < $total_pages; $i++) {
                                        if ($i == $page) {
                                            $active = "active";
                                        } else {
                                            $active = "";
                                        }
                                        echo '<li><a class="' . $active . '" href="students_list.php?page=' . $i . '">' . $i . '</a></li>';
                                    }
                                    if ($page < $total_pages) {
                                        echo '<li><a href="students_list.php?page=' . ($page + 1) . '">Next</a></li>';
                                    }
                                    echo '</ul>';
                                    echo '</nav>';
                                }
                                ?>
                                <!-- Pagination End -->
                        <?php
                            }
                        }
                        ?>

                        <?php
                        // if (isset($_SESSION['email'])) {
                        if (isset($_SESSION['usertype'])) {
                            $usertype = $_SESSION['usertype'];
                            if (isset($_SESSION['userid'])) {
                                $userid = $_SESSION['userid'];
                            }
                            if ($usertype == "user") {
                        ?>
                                <table class="styled-table">
                                    <thead>
                                        <tr>
                                            <th>User id</th>
                                            <th>Student id</th>
                                            <th>Student name</th>
                                            <th>Father name</th>
                                            <th>Gender</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Join Date</th>
                                            <th>End Date</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $record_per_page = 7;
                                        if (isset($_GET['page'])) {
                                            $page = $_GET['page'];
                                        } else {
                                            $page = 1;
                                        }

                                        $offset_value = ($page - 1) * $record_per_page;

                                        $sql_fetch = "SELECT * FROM `students` WHERE `user_id` = '$userid' LIMIT {$offset_value}, {$record_per_page}";
                                        $sql_fetch_run = mysqli_query($con, $sql_fetch);
                                        if (mysqli_num_rows($sql_fetch_run) > 0) {
                                            while ($row = mysqli_fetch_assoc($sql_fetch_run)) {
                                                $student_id = $row['id'];
                                                $user_id = $row['user_id'];
                                                $student_name = $row['student_name'];
                                                $father_name = $row['father_name'];
                                                $gender = $row['gender'];
                                                $mobile = $row['mobile'];
                                                $email = $row['email'];
                                                $address = $row['address'];
                                                $join_date = $row['join_date'];
                                                $end_date = $row['end_date'];
                                                $duration = $row['duration'];
                                                echo '<tr>
                                            <td>' . $user_id . '</td>
                                            <td>' . $student_id . '</td>
                                        <td>' . $student_name . '</td>
                                        <td>' . $father_name . '</td>
                                        <td>' . $gender . '</td>
                                        <td>' . $mobile . '</td>
                                        <td>' . $email . '</td>
                                        <td>' . $address . '</td>
                                        <td>' . $join_date . '</td>
                                        <td>' . $end_date . '</td>
                                        <td>' . $duration . '</td>
                                    </tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- Pagination Begin -->
                                <?php
                                $sql_pagination = "SELECT * FROM `students`";
                                $sql_pagination_run = mysqli_query($con, $sql_pagination);
                                if (mysqli_num_rows($sql_pagination_run) > 0) {
                                    $total_record = mysqli_num_rows($sql_pagination_run);
                                    $total_pages = ceil($total_record / $record_per_page);
                                ?>
                                <?php
                                    echo '<nav class="pagination">';
                                    echo  '<ul>';
                                    if ($page > 1) {
                                        echo  '<li><a href="students_list.php?page=' . ($page - 1) . '">Previous</a></li>';
                                    }
                                    for ($i = 1; $i < $total_pages; $i++) {
                                        if ($i == $page) {
                                            $active = "active";
                                        } else {
                                            $active = "";
                                        }
                                        echo '<li><a class="' . $active . '" href="students_list.php?page=' . $i . '">' . $i . '</a></li>';
                                    }
                                    if ($page < $total_pages) {
                                        echo '<li><a href="students_list.php?page=' . ($page + 1) . '">Next</a></li>';
                                    }
                                    echo '</ul>';
                                    echo '</nav>';
                                }
                                ?>
                                <!-- Pagination End -->
                        <?php }
                        } ?>

                    <?php
                    } else {
                        $_SESSION['status'] = "! Please Login.";
                        // header("location: login.php");
                        exit();
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- <div style="height: 600px;border:1px solid black"></div> -->
    </div>
</body>

</html>