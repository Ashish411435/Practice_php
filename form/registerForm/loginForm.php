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

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $sql = "SELECT * FROM `food_register` WHERE `email` = '$username' && `password` = '$password'";
            $result = mysqli_query($con, $sql);

            $rowcount = mysqli_num_rows($result);
            echo $rowcount;
            if ($rowcount > 0) {
                header("location:welcome.php");
                exit;
            } else {
                $_SESSION['invalidCred'] = "Invalid Credentials";
                // echo "<div class='alert alert-danger role='alert'> Invalid Credentials </div>";
                header("location:loginForm.php");
                exit;
            }
        }
        ?>
        <?php
            if(isset($_SESSION['invalidCred']) == true)
            {
                echo '<div class="alert alert-danger" role="alert">'. $_SESSION['invalidCred'] . '</div>';
                unset($_SESSION['invalidCred']);
            }
        ?>


        <!-- Pills navs -->
        <div class="container">

            <!-- Pills content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form action="loginForm.php" method="POST" onsubmit="return onSubmit()">
                        <div class="text-center mb-3">
                            <p>Sign in with:</p>
                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <a href="http://facebook.com"><i class="fa fa-facebook-f text-danger"></i></a>
                            </button>

                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <a href="http://gmail.com"> <i class="fa fa-google text-danger"></i> </a>
                            </button>

                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <a href="http://twitter.com"> <i class="fa fa-twitter text-danger"></i> </a>
                            </button>

                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <a href="http://github.com"><i class="fa fa-github text-danger"></i></a>
                            </button>
                        </div>

                        <p class="text-center">or:</p>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="loginName" name="username" class="form-control" placeholder="Enter Username" required />
                            <label class="form-label" for="loginName">Email or username</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="loginPassword" name="password" class="form-control" placeholder="Enter Password" required />
                            <label class="form-label" for="loginPassword">Password</label>
                        </div>

                        <!-- 2 column grid layout -->
                        <div class="row mb-4">
                            <div class="col-md-6 d-flex justify-content-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-3 mb-md-0 ">
                                    <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                    <label class="form-check-label" for="loginCheck"> Remember me </label>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex justify-content-center">
                                <!-- Simple link -->
                                <a href="#!" class="text-danger">Forgot password?</a>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-danger btn-block mb-4">Sign in</button>

                        <!-- Register buttons -->
                        <div class="text-center">
                            <p>Not a member? <a href="registerForm.php" class="text-danger">Register</a></p>
                        </div>
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