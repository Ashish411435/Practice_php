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

        if (isset($_SESSION['status']) == true) {
            echo '<div class="alert">' . $_SESSION['status'] . '</div>';
            unset($_SESSION['status']);
        }
        ?>
        <div class="adding_forms">
            <div class="btns_c">
                <a href="create_user.php" class="btns active addcat_btn">Create User</a>
                <a href="user_list.php" class="btns catlist_btn">User List</a>
            </div>
            <?php
            if (isset($_GET['user_id'])) {
                $user_id =  $_GET['user_id'];
            }
            $sql_data_fetch = "SELECT * FROM `register` WHERE `id` = $user_id";
            $sql_data_fetch_run = mysqli_query($con, $sql_data_fetch);
            if (mysqli_num_rows($sql_data_fetch_run) > 0) {
                while ($row = mysqli_fetch_assoc($sql_data_fetch_run)) {
                    $user_name = $row['name'];
                    $user_type = $row['user_type'];
                    $gender = $row['gender'];
                    $email = $row['email'];
                    $password = $row['pass'];
                    $mobile = $row['mobile'];
                    $status = $row['status'];
                }
            } else {
                $_SESSION['status'] = "No Record Found";
            }
            ?>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"> Edit User</h2>
                    <?php
                    // if (isset($_SESSION['email'])) {
                    ?>
                    <form action="update.php" method="post" enctype="multipart/form-data">
                        <div style="display: flex; justify-content:space-evenly;">
                            <div>
                                <div class="usertype inp_div">
                                    <label for="usertype">* User Type : </label>
                                    <select name="usertype" id="usertype">
                                        <option selected><?= $user_type ?></option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <!-- <div class="userid inp_div"> -->
                                    <!-- <label for="userid">* User Id : </label> -->
                                    <div>
                                        <input type="hidden" name="userid" id="userid" value="<?= $user_id ?>">
                                    </div>
                                <!-- </div> -->
                                <div class="username inp_div">
                                    <label for="username">* Enter Your Name : </label>
                                    <div>
                                        <input type="text" name="username" id="username" value="<?= $user_name ?>">
                                    </div>
                                </div>
                                <div class="email inp_div">
                                    <label for="email">* Enter Email Address : </label>
                                    <div>
                                        <input type="email" name="email" id="email" value="<?= $email ?>">
                                    </div>
                                </div>
                                <div class="password inp_div">
                                    <label for="password">* Enter Password : </label>
                                    <div>
                                        <input type="text" name="password" id="password" value="<?= $password ?>">
                                    </div>
                                </div>

                            </div>
                            <div>
                                <div class="mobile inp_div">
                                    <label for="mobile">* Enter Mobile Number : </label>
                                    <div>
                                        <input type="tel" name="mobile" id="mobile" value="<?= $mobile ?>">
                                    </div>
                                </div>
                                <div class="gender inp_div">
                                    <label for="gender">* Gender : </label>
                                    <select name="gender" id="gender">
                                        <option selected><?= $gender ?></option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Others</option>
                                    </select>
                                </div>
                                <div class="status inp_div">
                                    <label for="status">* Status : </label>
                                    <select name="status" id="status">
                                        <option selected><?= $status ?></option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="add_btn inp_div">
                            <button type="submit" class="btn" name="user_update">Create</button>
                        </div>
                    </form>
                    <?php
                    // }
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>