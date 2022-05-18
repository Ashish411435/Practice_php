<?php
session_start();
require "db_connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_reset_password($get_name, $get_email, $token)
{
    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer();

    //Server settings
    // $mail->SMTPDebug = 3;                      
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ashish32623@gmail.com';
    $mail->Password   = '@$#i$#411435';
    $mail->SMTPSecure = 'TLS';
    $mail->Port       =  587;

    //Recipients
    $mail->setFrom('ashish32623@gmail.com', 'Pass-Reset');
    $mail->addAddress($get_email, $get_name);
    $mail->addReplyTo('no-reply@example.com', 'no-reply');

    //Attachments
    $mail->addAttachment('');
    $mail->addAttachment('');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Password Recovery';
    $body_template = 'Dear' . $get_name .' We have received a request of password recovery. <br/>To Continue
    <b><a href="http://localhost/practice_php/form/password_reset/register_and_login/pass_change_form.php?token='.$token.'&email='.$get_email.'">Click here</a></b>';
    $mail->Body    = $body_template;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if ($mail->send()) {
        $_SESSION['statusAlert'] = 'Password Recovery link has been sent to ' . $get_email . '';
        header("location:loginForm.php");
        exit();
    } else {
        $_SESSION['notFound'] = "Mail could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("location:pass_reset.php");
        exit();
    }
}

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

    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- End Font Awesome Link -->


    <title>Login Form</title>
    <style>
        .container {
            padding: 40px 20px;
            width: 500px !important;
        }
    </style>
</head>

<body>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $token = md5(rand());

        $sql = "SELECT `email` FROM `food_register` WHERE `email` = '$username'";
        $result = mysqli_query($con, $sql);
        $rowcount = mysqli_num_rows($result);
        echo $rowcount;
        if ($rowcount > 0) {
            $row = mysqli_fetch_assoc($result);
            $get_name = $row['name'];
            $get_email = $row['email'];

            $update_token = "UPDATE `food_register` SET `token` = '$token' WHERE `email` = '$get_email'";
            $update_token_result = mysqli_query($con, $update_token);

            if ($update_token_result) {
                send_reset_password($get_name, $get_email, $token);
            } else {
                $_SESSION['statusAlert'] = "Oops something went wrong... #tokNotUpdate";
                header("location:pass_reset.php");
                exit();
            }
        } else {
            $_SESSION['statusAlert'] = "Please enter a valid email";
            header("location:pass_reset.php");
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

    <section class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand font-weight-bold text-danger" href="#">Coding</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Feedback</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
                <div class="mx-3">
                    <a href="registerForm.php" class="active"><button class="btn btn-outline-danger btn-sm my-sm-0" type="submit">Register</button></a>
                    <a href="loginForm.php" class="mx-1"><button class="active btn btn-outline-primary btn-sm my-sm-0" type="submit">Login</button></a>
                </div>
            </div>
        </nav>

        <!-- Pills navs -->
        <div class="container">

            <!-- Pills content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <h2 class="text-uppercase text-center text-danger mb-5 ">Reset Password</h2>
                    <form action="pass_reset.php" method="POST" onsubmit="return onSubmit()">

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="loginName" name="username" class="form-control" placeholder="Enter Username" required />
                            <label class="form-label" for="loginName">Email or Username</label>
                        </div>
                        <!-- Submit button -->
                        <button type="submit" name="send_recovery_btn" class="btn btn-danger btn-block mb-4">Send Recovery Link</button>

                    </form>
                </div>
            </div>
            <!-- Pills content -->
        </div>
    </section>


    <!-- Optional JavaScript; choose one of the two! -->

    <script>
        function onSubmit() {

            var loginName = document.getElementById("loginName");
            var loginPassword = document.getElementById("loginPassword");

            if (loginName.value == "") {
                alert("Please Enter Username");
                return false;
            }
            if (loginPassword.value == "") {
                alert("Please Enter Password");
                return false;
            }
        }
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>