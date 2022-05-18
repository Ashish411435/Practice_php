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

    <title>Register Form</title>
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($confirmPassword != $password) {

            echo "<div class='alert alert-danger' role='alert'>Password Doesn't Match </div>";
        } else {

            $sql = "SELECT * FROM `food_register` WHERE `email` = '$email'";
            $result = mysqli_query($con, $sql);
            $rowcount = mysqli_num_rows($result);
            if ($rowcount > 0) {
                echo "<div class='alert alert-danger' role='alert'> Email Already Been Taken </div>";
            } else {
                $hash_pwd = md5($password);
                $sql = "INSERT INTO `food_register` (`name`, `email`, `password`) VALUES ('$name','$email','$hash_pwd');";

                $result = mysqli_query($con, $sql);
                if ($result) {
                    // echo "<div class='alert alert-success' role='alert'>Successfully Registered</div>";
                    $_SESSION['successRegister'] = "Successfully Registred";
                    header("location:registerForm.php");
                    exit;
                } else {
                    // echo "<div class='alert alert-dander' role='alert'>Something Went Wrong...</div>";
                    $_SESSION['failRegister'] = "Registration Failed";
                    header("location:registerForm.php");
                    exit;
                }
            }
        }
    }
    ?>

    <?php
    if(isset($_SESSION['successRegister']) == true)
    {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['successRegister'] . '</div>';
        unset($_SESSION['successRegister']);
    }

    if(isset($_SESSION['failRegister']) == true)
    {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['failRegister'] . '</div>';
        unset($_SESSION['failRegister']);
    }
    ?>
    
    <!-- <h1 class="text-center my-5 text-danger">Registration Form</h1> -->

    <!-- Start Register Form -->
    <section class="vh-100 bg-image my-5" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center text-danger mb-5 ">Create an account</h2>

                                <!-- Start Form -->
                                <form action="registerForm.php" onsubmit="return formSubmit()" method="post">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="myName">Your Name : </label>
                                        <input type="text" id="myName" class="form-control form-control-lg" name="name" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="myEmail">Your Email : </label>
                                        <input type="email" id="myEmail" class="form-control form-control-lg" name="email" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="myPassword">Password : </label>
                                        <input type="password" id="myPassword" class="form-control form-control-lg" name="password" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="myConfirmPassword">Confirm Password : </label>
                                        <input type="password" id="myConfirmPassword" class="form-control form-control-lg" name="confirmPassword" />
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <label class="form-check-label" for="form2Example3g">
                                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                                            I agree all statements in <a href="#!" class="text-body"><u class="text-danger">Terms of service</u></a>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-danger btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="loginForm.php" class="fw-bold text-danger text-body"><u>Login here</u></a></p>

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

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>