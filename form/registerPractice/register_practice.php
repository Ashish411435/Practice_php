<?php

require_once("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = md5($_POST['password']);
    $confirmPassword = md5($_POST['confirmPassword']);

    if ($password != $confirmPassword) {
        echo "Password Doesn't Match";
    } else {

        $sql = "SELECT * FROM `register_practice` WHERE `email` = '$email' || `mobile` = '$mobile' ";
        $query_result = mysqli_query($con, $sql);

        $row_count = mysqli_num_rows($query_result);
        // echo $row_count;
        if ($row_count > 0) {
            echo "<div class='alert alert-danger' role='alert'> Email or Mobile already exist ! </div> '";
        } else {
            // $hash_password = md5(($password));
            $sql = "INSERT INTO `register_practice` (fullname, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password');";

            $query_result = mysqli_query($con, $sql);
            // echo var_dump($query_result);
            if ($query_result) {
                echo "<div class='alert alert-success' role='alert'> Successfully Registered </div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'> Registration Failed </div>";
            }
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Practice Form</title>

    <!-- Start Bootstrap Css -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <!-- End Bootstrap Css -->

    <style>
        .container {
            padding: 10px;
        }
    </style>
</head>

<body>
    <article class="bg-secondary mb-3">
        <br><br>
    </article>
    <div class="container">
        
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Create Account</h4>
                <p class="text-center">Get started with your free account</p>
                <p>
                    <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
                    <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
                </p>
                <p class="divider-text">
                    <span class="bg-light">OR</span>
                </p>

                <!-- Start Form -->
                <form action="register_practice.php" method="POST" onsubmit="return formSubmit()">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="name" class="form-control allInp" placeholder="Full name" type="text">
                    </div>
                    <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="email" class="form-control allInp" placeholder="Email address" type="email">
                    </div>
                    <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                        </div>
                        <select class="custom-select" style="max-width: 120px;">
                            <option selected="">+91</option>
                            <option value="1">+972</option>
                            <option value="2">+198</option>
                            <option value="3">+701</option>
                        </select>
                        <input name="mobile" class="form-control allInp" placeholder="Phone number" type="text">
                    </div>
                    <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select name="jobOption" class="form-control">
                            <option selected=""> Select job type</option>
                            <option value="designer">Designer</option>
                            <option value="manager">Manager</option>
                            <option value="accounting">Accounting</option>
                        </select>
                    </div>
                    <!-- form-group end.// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input name="password" class="form-control allInp" placeholder="Create password" type="password">
                    </div>
                    <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input name="confirmPassword" class="form-control allInp" placeholder="Confirm password" type="password">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Create Account </button>
                    </div> <!-- form-group// -->
                    <p class="text-center">Have an account? <a href="login_practice.php">Log In</a> </p>
                </form>
            </article>
        </div> <!-- card.// -->

    </div>
    <!--container end.//-->

    <br><br>
    <article class="bg-secondary mb-3">
        <br><br>
    </article>

    <script>
        function formSubmit() {
            var allInp = document.querySelectorAll(".allInp");

            for (let i = 0; i <= allInp.length; i++) {
                if (allInp[i].value == "") {
                    alert("Please Fill Blank Fields");
                    return false;
                }
            }
        }
    </script>
</body>

</html>