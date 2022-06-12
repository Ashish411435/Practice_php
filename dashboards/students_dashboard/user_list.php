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
                <a href="create_user.php" class="btns addcat_btn">Create User</a>
                <a href="user_list.php" class="btns active catlist_btn">User List</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">---User List---</h2>
                    <?php
                    if (isset($_SESSION['email'])) {
                    ?>
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>User Type</th>
                                    <th>Status</th>
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

                                $sql_fetch = "SELECT * FROM `register` LIMIT {$offset_value}, {$record_per_page}";
                                $sql_fetch_run = mysqli_query($con, $sql_fetch);
                                if (mysqli_num_rows($sql_fetch_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($sql_fetch_run)) {
                                        $user_id = $row['id'];
                                        $name = $row['name'];
                                        $gender = $row['gender'];
                                        $email = $row['email'];
                                        $mobile = $row['mobile'];
                                        $user_type = $row['user_type'];
                                        $status = $row['status'];
                                        echo '<tr>
                                        <td>' . $user_id . '</td>
                                        <td>' . $name . '</td>
                                        <td>' . $gender . '</td>
                                        <td>' . $email . '</td>
                                        <td>' . $mobile . '</td>
                                        <td>' . $user_type . '</td>
                                        <td>' . $status . '</td>
                                        <td><a class="edit_btn" href="">Edit</a></td>
                                        <td><a class="delete_btn" href="delete.php?user_id=' . $user_id . '&page=' . $page . '">Delete</a></td>
                                    </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- Pagination Begin -->
                        <?php
                        $sql_pagination = "SELECT * FROM `register`";
                        $sql_pagination_run = mysqli_query($con, $sql_pagination);
                        if (mysqli_num_rows($sql_pagination_run) > 0) {
                            $total_record = mysqli_num_rows($sql_pagination_run);
                            $total_pages = ceil($total_record / $record_per_page);
                        ?>
                        <?php
                            echo '<nav class="pagination">';
                            echo  '<ul>';
                            if ($page > 1) {
                                echo  '<li><a href="user_list.php?page=' . ($page - 1) . '">Previous</a></li>';
                            }
                            for ($i = 1; $i < $total_pages; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo '<li><a class="' . $active . '" href="user_list.php?page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($page < $total_pages) {
                                echo '<li><a href="user_list.php?page=' . ($page + 1) . '">Next</a></li>';
                            }
                            echo '</ul>';
                            echo '</nav>';
                        }
                        ?>
                        <!-- Pagination End -->
                    <?php } else {
                        $_SESSION['status'] = "! Please Login.";
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