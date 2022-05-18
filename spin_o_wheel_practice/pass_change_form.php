<?php session_start(); ?>
<?php
require("connect.php");
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Google Fonts Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons Link -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

    <title>Admin Login</title>
    <style>
        * {
            font-family: 'Open Sans', sans-serif;
        }

        body {
            background-color: #8BC6EC;
            background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);

        }

        .card {
            border: none;
            border-radius: 5%;
            outline: none;
            /* box-shadow: 1px 1px 1px 2px rgb(220, 219, 219); */
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }

        ::placeholder {
            color: grey !important;
        }
    </style>
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $token = $_POST['token'];
        $username = $_POST['username'];
        $new_password = md5($_POST['new_password']);
        $confpassword = md5($_POST['confpassword']);

        if (!$token == "") {
            if ($new_password != $confpassword) {
                $_SESSION['passNotMatch'] = "Password and confirm password doesn't match";
            } else {
                $check_token = "SELECT `verification_token` FROM `admin_register` WHERE `verification_token` = '$token'";
                $check_token_result = mysqli_query($con, $check_token);
                $row_count = mysqli_num_rows($check_token_result);
                if ($row_count > 0) {
                    $update_pass = "UPDATE `admin_register` SET `password` = '$new_password' WHERE `verification_token` = '$token'";
                    $update_pass_result = mysqli_query($con, $update_pass);
                    if ($update_pass_result) {
                        $new_token = md5(rand()) . 'Klola';
                        $update_token = "UPDATE `admin_register` SET `verification_token` = '$new_token' WHERE `verification_token` = '$token'";
                        $update_token_result = mysqli_query($con, $update_token);
                        if ($update_token_result) {
                            $_SESSION['statusAlert'] = "Successfully changed password";
                            header("Location: admin_login.php");
                            exit();
                        } else {
                            $_SESSION['statusAlert'] = "Something Went Wrong...#tokNotUpd";
                            header("Location: pass_change_form.php?email=$username&token=$token");
                            exit();
                        }
                    } else {
                        $_SESSION['statusAlert'] = "Did not update password. Something went wrong...";
                        header("Location: pass_change_form.php?email=$username&token=$token");
                        exit();
                    }
                } else {
                    $_SESSION['statusAlert'] = "Something went wrong...#invalidtoken";
                    header("Location: pass_change_form.php?email=$username&token=$token");
                    exit();
                }
            }
        } else {
            $_SESSION['statusAlert'] = "Something Went Wrong...#tokNotValid";
            header("Location: pass_change_form.php?email=$username&token=$token");
            exit();
        }
    }
    ?>

    <?php
    if (isset($_SESSION['statusAlert'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['statusAlert'] . '</div>';
        unset($_SESSION['statusAlert']);
    }
    ?>

    <!-- Login Form -->
    <section class="admin_login d-flex justify-content-center" style="padding-top: 4rem; padding-bottom: 1rem;">
        <div>
            <div class="col-12 my-4 text-center">
                <a href="admin_login.php"><button class="btn btn-block btn-lg" style="background-color: #6a98b7; color: white; padding:10px; font-weight:bold;">Login</button></a>
            </div>
        </div>
        <div class="card" style="width: 30rem; padding: 0px 35px;">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="fa fa-user-o" style="background-color: #6a98b7; color: white; padding: 25px 29px; font-size: 2rem; border-radius: 50%;" aria-hidden="true"></i>
                </div>
                <h5 class="card-title text-center mb-3" style="color: #6a98b7; font-size: 2rem; font-weight: bold;">Recover Your Password</h5>
                <form action="pass_change_form.php" method="post">
                    <div class="form-floating mb-2">
                        <input type="hidden" class="form-control" name="token" id="mytoken" value="<?php if (isset($_GET['token'])) {
                                                                                                        echo $_GET['token'];
                                                                                                    } ?>" required>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="hidden" class="form-control" name="username" id="myusername" value="<?php if (isset($_GET['email'])) {
                                                                                                            echo $_GET['email'];
                                                                                                        } ?>" required>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" name="new_password" id="my_new_password" placeholder="Enter New Password" required>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" name="confpassword" id="myconfpassword" placeholder="Confirm Password" required>
                    </div>
                    <div class="col-12 my-4 text-center">
                        <button class="btn btn-block btn-lg" style="background-color: #6a98b7; color: white; padding:10px; font-weight:bold;" type="submit">Register</button>
                    </div>
                    <!-- <a href="#" class="btn btn-primary">Login</a> -->
                </form>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>