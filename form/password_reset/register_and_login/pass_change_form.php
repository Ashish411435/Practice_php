<?php

session_start();
require("db_connection.php");

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome link -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <title>Recover Your Password</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand font-weight-bold text-danger" href="#">Coding</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
            <div class="mx-3">
                <a href="registerForm.php" class="active"><button class="active btn btn-outline-danger btn-sm my-sm-0" type="submit">Register</button></a>
                <a href="loginForm.php" class="mx-1"><button class="btn btn-outline-primary btn-sm my-sm-0" type="submit">Login</button></a>
            </div>

        </div>
    </nav>

    <?php
    if (isset($_POST['pass_update_btn'])) {

        $email = $_POST['email'];
        $new_password = md5($_POST['new_password']);
        $confirmPassword = md5($_POST['confirmPassword']);
        $token = $_POST['pass_token'];

        if (!empty($token)) {
            if (!empty($email) && !empty($new_password) && !empty($confirmPassword)) {

                $check_token = "SELECT `token` FROM `food_register` WHERE `token` = '$token'";
                $check_token_result = mysqli_query($con, $check_token);
                $row_count = mysqli_num_rows($check_token_result);
                echo $row_count;
                if ($row_count > 0) {

                    if ($new_password === $confirmPassword) {
                        $update_pass = "UPDATE `food_register` SET `password` = '$new_password' WHERE `token` = '$token'";
                        $update_pass_result = mysqli_query($con, $update_pass);

                        if ($update_pass_result) {
                            $new_token = md5(rand());
                            $update_token = "UPDATE `food_register` SET `token` = '$new_token' WHERE `token` = '$token'";
                            $update_token_result = mysqli_query($con, $update_token);
                            if ($update_token_result) {
                                $_SESSION['statusAlert'] = "New password successfully updated...";
                                header("Location: loginForm.php");
                                exit();
                            } else {
                                $_SESSION['statusAlert'] = "Something went wrong...#tokNotUpd";
                                header("Location: pass_change_form.php?token=$token&email=$email");
                                exit();
                            }
                        } else {
                            $_SESSION['statusAlert'] = "Did not update password. Something went wrong...";
                            header("Location: pass_change_form.php?token=$token&email=$email");
                            exit();
                        }
                    } else {
                        $_SESSION['statusAlert'] = "Password and confirm doesn't match.";
                        header("Location: pass_change_form.php?token=$token&email=$email");
                        exit();
                    }
                } else {
                    $_SESSION['statusAlert'] = "Invalid Token...#";
                    header("Location: pass_change_form.php?token=$token&email=$email");
                    exit();
                }
            } else {
                $_SESSION['statusAlert'] = "All fields are mandatory...";
                header("Location: pass_change_form.php?token=$token&email=$email");
                exit();
            }
        } else {
            $_SESSION['statusAlert'] = "No Token Available";
            header("Location: pass_change_form.php");
            exit();
        }
    }

    ?>

    <?php
    if (isset($_SESSION['statusAlert']) == true) {
        echo '<div class="alert alert-warning" role="alert">' . $_SESSION['statusAlert'] . '</div>';
        unset($_SESSION['statusAlert']);
    }
    ?>

    <!-- <h1 class="text-center my-5 text-danger">Registration Form</h1> -->

    <!-- Start Register Form -->
    <section class="bg-image my-5">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center text-danger mb-3 ">Reset Your Password</h2>

                                <!-- Start Form -->
                                <form action="pass_change_form.php" onsubmit="return formSubmit()" method="post">

                                    <div class="form-outline mb-3">
                                        <input type="text" id="mytoken" class="form-control form-control-lg" value="<?php if (isset($_GET['token'])) {
                                                                                                                        echo $_GET['token'];
                                                                                                                    } ?>" name="pass_token" />
                                    </div>
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="myPassword">Email : </label>
                                        <input type="text" id="myEmail" value="<?php if (isset($_GET['email'])) {
                                                                                    echo $_GET['email'];
                                                                                } ?>" class="form-control form-control-lg" name="email" />
                                    </div>
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="myPassword">New Password : </label>
                                        <input type="password" id="myNewPassword" class="form-control form-control-lg" name="new_password" />
                                    </div>
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="myConfirmPassword">Confirm Password : </label>
                                        <input type="password" id="myConfirmPassword" class="form-control form-control-lg" name="confirmPassword" />
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="pass_update_btn" class="btn btn-danger btn-block btn-lg gradient-custom-4 text-body">Change Password</button>
                                    </div>

                                    <p class="text-center text-muted mt-3 mb-0">Have already an account? <a href="loginForm.php" class="fw-bold text-danger text-body"><u>Login here</u></a></p>

                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Register Form -->

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="registerForm.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>