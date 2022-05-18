<?php
session_start();
require("connect.php");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_password_reset($get_name, $get_email, $token)
{

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);


    //Server settings
    // $mail->SMTPDebug = 3;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ashish32623@gmail.com';                     //SMTP username
    $mail->Password   = '@$#i$#411435';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       =  587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ashish32623@gmail.com', 'Password-Reset');
    $mail->addAddress($get_email, $get_name);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('no-reply@gmail.com', 'No-reply');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Recovery Password';
    $body_template = 'Dear, ' . $get_name . '<p>We have received a password recovery request. To continue</p><a href="http://localhost/practice_php/spin_o_wheel/pass_change_form.php?email=' . $get_email . '&token=' . $token . '">Click here</a>';
    $mail->Body    = $body_template;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if ($mail->send()) {
        $_SESSION['statusAlert'] = "Recovery link has been sent to " . $get_email;
        header("Location: admin_login.php");
        exit();
    } else {
        $_SESSION['statusAlert'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}" . $get_email;
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

    <!-- Google Fonts Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons Link -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

    <title>Password Recovery</title>
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
    if (isset($_POST['reset_link_btn'])) {

        $username = $_POST['username'];
        $token = md5(rand());

        $sql_query = "SELECT * FROM `admin_register` WHERE `username` = '$username'";
        $result = mysqli_query($con, $sql_query);
        $row_count = mysqli_num_rows($result);
        // echo $row_count;
        if ($row_count > 0) {
            $row = mysqli_fetch_assoc($result);
            $get_name = $row['name'];
            $get_email = $row['username'];

            $update_token = "UPDATE `admin_register` SET `verification_token` = '$token' WHERE `username` = '$username'";
            $update_token_result = mysqli_query($con, $update_token);
            if ($update_token_result) {
                send_password_reset($get_name, $get_email, $token);
            } else {
                $_SESSION['statusAlert'] = "Something Went Wrong... #tokNotUpd";
                header("Location: forgot_password.php");
                exit();
            }
        }
    }

    ?>

    <!-- Login Form -->
    <section class="admin_login d-flex justify-content-center" style="padding-top: 6rem; padding-bottom: 1rem;">
        <?php
            if(isset($_SESSION['statusAlert'])){
                echo '<div class="alert alert-info" role="alert"> '.$_SESSION['statusAlert'].'</div>';
            }
        ?>
        <div>
            <div class="col-12 my-4 text-center">
                <a href="admin_login.php"><button class="btn btn-block btn-lg" style="background-color: #6a98b7; color: white; padding:10px; font-weight:bold;">Login</button></a>
            </div>
        </div>
        <div class="card" style="width: 30rem; padding: 0px 35px;">
            <div class="card-body">
                <div class="text-center mb-3">
                    <!-- <div style="margin: auto; border: 1px solid black;"> -->
                    <i class="fa fa-user-o" style="background-color: #6a98b7; color: white; padding: 25px 29px; font-size: 2rem; border-radius: 50%;" aria-hidden="true"></i>
                </div>
                <h5 class="card-title text-center mb-3" style="color: #6a98b7; font-size: 2rem; font-weight: bold;">Recover Your Password</h5>

                <form action="forgot_password.php" method="post">

                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" name="username" id="myusername" placeholder="Enter Username" required>
                    </div>

                    <div class="col-12 my-4 text-center">
                        <button class="btn btn-block btn-lg" style="background-color: #6a98b7; color: white; padding:10px; font-weight:bold;" name="reset_link_btn">Send Link</button>
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