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

        .main_content .adding_forms .card {
            width: 32rem;
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
                <a href="add_student.php" class="btns active addcat_btn">Add Student</a>
                <a href="students_list.php" class="btns catlist_btn">Students List</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Add Student</h2>
                    <?php
                    if (isset($_SESSION['email'])) {
                    ?>
                        <form action="handle.php" method="post" enctype="multipart/form-data">
                            <div class="form_content" style="display: flex; justify-content: space-between;">
                                <div style="width: 16rem;">
                                    <!-- <label for="userid">* User id : </label> -->
                                    <input type="hidden" name="userid" id="userid" value="<?php if (isset($_SESSION['userid'])) {
                                                                                                echo $_SESSION['userid'];
                                                                                            } ?>">

                                    <!-- <label for="usertype">* User Type : </label> -->
                                    <input type="hidden" name="usertype" id="usertype" value="<?php if (isset($_SESSION['usertype'])) {
                                                                                                    echo $_SESSION['usertype'];
                                                                                                } ?>">

                                    <div class="student_name inp_div">
                                        <label for="student_name">* Student Name : </label>
                                        <div>
                                            <input type="text" name="student_name" id="student_name">
                                        </div>
                                    </div>
                                    <div class="father_name inp_div">
                                        <label for="father_name">* Father Name : </label>
                                        <div>
                                            <input type="text" name="father_name" id="father_name">
                                        </div>
                                    </div>
                                    <div class="mobile inp_div">
                                        <label for="mobile">* Mobile Number : </label>
                                        <div>
                                            <input type="tel" name="mobile" id="mobile">
                                        </div>
                                    </div>
                                    <div class="email inp_div">
                                        <label for="email">* Email Address : </label>
                                        <div>
                                            <input type="email" name="email" id="email">
                                        </div>
                                    </div>
                                    <div class="gender inp_div">
                                        <label for="gender">* Gender : </label>
                                        <div>
                                            <select name="gender" id="gender">
                                                <option selected disabled>-Select Gender-</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div style="width: 16rem;">
                                    <div class="address inp_div">
                                        <label for="address">* Address : </label>
                                        <div>
                                            <textarea name="address" id="address" cols="20" rows="1" style="border: none;"></textarea>
                                        </div>
                                    </div>
                                    <div class="duration inp_div">
                                        <label for="duration">Duration : </label>
                                        <div>
                                            <!-- <input type="text" name="duration" id="duration" placeholder="In Months"> -->
                                            <select name="year" id="year">
                                                <option disabled selected>-Select year-</option>
                                                <option value="0 year">Null</option>
                                                <?php
                                                $sql = "SELECT * FROM `year` ";
                                                $sql_run = mysqli_query($con, $sql);
                                                if (mysqli_num_rows($sql_run) > 0) {
                                                    while ($row = mysqli_fetch_assoc($sql_run)) {
                                                        $year = $row['year'];
                                                ?>
                                                        <option value="<?= $year . ' year' ?>"><?= $year ?></option>
                                                <?php
                                                    }
                                                }

                                                ?>
                                            </select>

                                            <select name="month" id="month">
                                                <option disabled selected>-Select Month-</option>
                                                <option value="0 Months">Null</option>
                                                <?php
                                                $sql = "SELECT * FROM `months` ";
                                                $sql_run = mysqli_query($con, $sql);
                                                if (mysqli_num_rows($sql_run) > 0) {
                                                    while ($row = mysqli_fetch_assoc($sql_run)) {
                                                        $months = $row['months'];
                                                ?>
                                                        <option value="<?= $months . ' Months' ?>"><?= $months ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <select name="day" id="day">
                                                <option disabled selected>-Select days-</option>
                                                <option value="0 days">Null</option>
                                                <?php
                                                $sql = "SELECT * FROM `days`";
                                                $sql_run = mysqli_query($con, $sql);
                                                if (mysqli_num_rows($sql_run) > 0) {
                                                    while ($row = mysqli_fetch_assoc($sql_run)) {
                                                        $days = $row['days'];
                                                ?>
                                                        <option value="<?= $days . ' days' ?>"><?= $days ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="join_date inp_div">
                                        <label for="join_date">Join Date : </label>
                                        <div>
                                            <input type="date" name="join_date" id="join_date">
                                        </div>
                                    </div>
                                    <!-- <div class="end_date inp_div" style="margin-top: 10px;">
                                    <label for="end_date" style="margin-bottom: 10px;">End Date : </label>
                                    <div>
                                        <input type="text" name="end_date" id="end_date" placeholder="yyyy-dd-mm">
                                    </div>
                                </div> -->
                                </div>
                            </div>

                            <div class="add_btn inp_div">
                                <button type="submit" class="btn btn-primary" name="add_student">Add</button>
                            </div>
                        </form>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>