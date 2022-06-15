<?php
include "connect.php";
session_start();

/* =============> Begin Register Form <============== */
if (isset($_POST['register_form'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    if ($name == "" || $email == "" || $mobile == "" || $password == "") {
        $_SESSION['status'] = "! Please fill required fields.";
        header("location: register.php");
    } else {
        $sql_check = "SELECT * FROM `register` where `mobile` = '$mobile' OR `email` = '$email'";
        $sql_check_run = mysqli_query($con, $sql_check);
        if (mysqli_num_rows($sql_check_run) > 0) {
            $_SESSION['status'] = "! Email or mobile already exist.";
            header("location: register.php");
        } else {
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);

            $sql_insert = "INSERT INTO `register` (`name`, `email`, `pass`, `mobile`) VALUES ('$name','$email','$pass_hash', '$mobile')";

            $sql_insert_run = mysqli_query($con, $sql_insert);
            if ($sql_insert_run) {
                $_SESSION['status'] = "Successfully Registered.";
                header("location: login.php");
            } else {
                $_SESSION['status'] = "! Something Went wrong... Cannot Registered.";
                header("location: register.php");
            }
        }
    }
}
/* ==========> End Register Form <============ */

/* =============> Begin Create User Form <============== */
if (isset($_POST['create_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $usertype = $_POST['usertype'];
    $status = $_POST['status'];

    if ($name == "" || $email == "" || $mobile == "" || $password == "" || $gender == "" ||  $status == "") {
        $_SESSION['status'] = "! Please fill required fields.";
        header("location: create_user.php");
    } else {
        $sql_check = "SELECT * FROM `register` where `mobile` = '$mobile' OR `email` = '$email'";
        $sql_check_run = mysqli_query($con, $sql_check);
        if (mysqli_num_rows($sql_check_run) > 0) {
            $_SESSION['status'] = "! Email or mobile already exist.";
            header("location: create_user.php");
        } else {
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);

            $sql_insert = "INSERT INTO `register` (`name`, `email`, `gender`, `pass`, `mobile`, `user_type`, `status`) VALUES ('$name','$email', '$gender' ,'$pass_hash', '$mobile', '$usertype', '$status')";

            $sql_insert_run = mysqli_query($con, $sql_insert);
            if ($sql_insert_run) {
                $_SESSION['status'] = "Successfully Registered.";
                header("location: create_user.php");
            } else {
                $_SESSION['status'] = "! Something Went wrong... Cannot Registered.";
                header("location: create_user.php");
            }
        }
    }
}
/* ==========> End Create User Form <============ */


/* ===============> Begin Login Form <============== */
if (isset($_POST['login_form'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == "" || $password == "") {
        $_SESSION['status'] = "! Please fill required fields.";
        header("location: login.php");
    } else {
        $sql_check = "SELECT * FROM `register` where `email` = '$email'";
        $sql_check_run = mysqli_query($con, $sql_check);
        if (mysqli_num_rows($sql_check_run) > 0) {
            while ($row = mysqli_fetch_assoc($sql_check_run)) {
                $userid = $row['id'];
                $hash_pass = $row['pass'];
                $username = $row['name'];
                $usertype = $row['user_type'];
                // echo $hash_pass;
                if (password_verify($password, $hash_pass)) {
                    if ($usertype == "admin") {
                        $_SESSION['email'] = $email;
                        $_SESSION['username'] = $username;
                        $_SESSION['usertype'] = $usertype;
                        $_SESSION['userid'] = $userid;
                        header("location: admin_dashboard.php");
                        exit();
                    } else if ($usertype == "user") {
                        $_SESSION['email'] = $email;
                        $_SESSION['username'] = $username;
                        $_SESSION['usertype'] = $usertype;
                        $_SESSION['userid'] = $userid;
                        header("location: user_dashboard.php");
                        exit();
                    } else {
                        $_SESSION['status'] = "! User type not defined.";
                        header("location: login.php");
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "! Email or password doesn't match.";
                    header("location: login.php");
                    exit();
                }
            }
        } else {
            $_SESSION['status'] = "! Username doesn't exist.";
            header("location: login.php");
            exit();
        }
    }
}
/* ===============> End Login Form <============== */


/* ===============> Begin Add Students Form <=============== */
if (isset($_POST['add_student'])) {
    $userid = $_POST['userid'];
    $usertype = $_POST['usertype'];
    $student_name = $_POST['student_name'];
    $father_name = $_POST['father_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    /* ====> Begin Duration Code <==== */
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $duration = $year . " " . $month . " " . $day;
    /* ====> End Duration Code <==== */

    /* ====> Begin Duration Code <==== */
    $join_date = $_POST['join_date'];
    $jd = date_create($join_date);
    date_add($jd, date_interval_create_from_date_string($duration));
    $end_date = date_format($jd, 'Y-m-d');
    /* ====> Begin Duration Code <==== */
    // $end_date = $_POST['end_date'];

    if ($student_name == "" || $father_name == "" || $mobile == "" || $email == "" || $year == "" && $month == "" && $day || $gender == "" || $address == "" || $join_date == "" || $duration == "") {
        $_SESSION['status'] = "! Please fill required fields.";
        header("location: add_student.php");
    } else {
        $sql_check = "SELECT * FROM `students` where `mobile` = '$mobile' || `email` = '$email'";
        $sql_check_run = mysqli_query($con, $sql_check);
        if (mysqli_num_rows($sql_check_run) > 0) {
            $_SESSION['status'] = "! Data Already Exist.";
            header("location: add_student.php");
            exit();
        } else {
            $sql_insert = "INSERT INTO `students` (`student_name`, `user_id`, `user_type`, `father_name`, `gender`, `mobile`, `email`, `address`, `join_date`, `end_date`, `duration`, `duration_year`, `duration_month`, `duration_days` ) VALUES ('$student_name', '$userid','$usertype', '$father_name', '$gender', '$mobile', '$email', '$address', '$join_date', '$end_date', '$duration', '$year', '$month', '$day')";
            // die();
            $sql_insert_run = mysqli_query($con, $sql_insert);
            if ($sql_insert_run) {
                $_SESSION['status'] = "Successfully Inserted.";
                header("location: add_student.php");
                exit();
            } else {
                $_SESSION['status'] = "! Something Went wrong... Not Inserted.";
                header("location: add_student.php");
                exit();
            }
        }
    }
}
/* ===============> End Add Students Form <=============== */

/* ===============> Begin Update Students Form <=============== */
if (isset($_POST['update_student'])) {
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $father_name = $_POST['father_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    /* ====> Begin Duration Code <==== */
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $duration = $year . " " . $month . " " . $day;
    /* ====> End Duration Code <==== */

    /* ====> Begin Duration Code <==== */
    $join_date = $_POST['join_date'];
    $jd = date_create($join_date);
    date_add($jd, date_interval_create_from_date_string($duration));
    $end_date = date_format($jd, 'Y-m-d');
    /* ====> Begin Duration Code <==== */

    $sql_update = "UPDATE `students` SET `student_name` = '$student_name', `father_name` = '$father_name', `gender` = '$gender' , `mobile` ='$mobile', `email` = '$email', `address` = '$address', `join_date` = '$join_date', `end_date` = '$end_date', `duration` = '$duration', `duration_year` = '$year', `duration_month` = '$month', `duration_days` = '$day' WHERE `id` = $student_id";
    // die();
    $sql_update_run = mysqli_query($con, $sql_update);
    if ($sql_update_run) {
        $_SESSION['status'] = "Successfully Updated.";
        header("location: students_list.php");
        exit();
    } else {
        $_SESSION['status'] = mysqli_connect_error();
        header("location: students_list.php");
        exit();
    }
}
/* ===============> End Update Students Form <=============== */


/* =============> Begin Automatic dropdown <============== */
if (isset($_POST['categoryId'])) {
    $catId = $_POST['categoryId'];
    $sql = "SELECT * FROM `sub_category` WHERE `cat_id` = '$catId'";
    $sql_run = mysqli_query($con, $sql);
    if (mysqli_num_rows($sql_run) > 0) {
        while ($row = mysqli_fetch_assoc($sql_run)) {
            $sub_id = $row['sub_id'];
            $sub_name = $row['sub_name'];
?>
            <select name="subcategory" id="subcategory">
                <option value="<?= $sub_id ?>"><?= $sub_name ?></option>
            </select>
<?php
        }
    }
}
/* ======> End Automatic dropdown <======= */



/* End Logout  */
if (isset($_POST['logout_btn'])) {
    unset($_SESSION['email']);
    unset($_SESSION['username']);
    session_destroy();
    session_abort();
    header("location: login.php");
    exit();
}
/* End Logout  */
