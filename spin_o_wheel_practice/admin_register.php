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
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $confpassword = md5($_POST['confpassword']);

        if ($password != $confpassword) {
            $_SESSION['passNotMatch'] = "Password and confirm password doesn't match";
        } else {
            $sql_query = "SELECT * FROM `admin_register` WHERE `username` = '$username'";
            $result = mysqli_query($con, $sql_query);
            $row_count = mysqli_num_rows($result);
            if ($row_count > 0) {
                $_SESSION['statusAlert'] = "Email Already Exist...";
                header("Location: admin_register.php");
                exit();
            } else {
                $sql_query = "INSERT INTO `admin_register` (`name`, `username`, `password`) VALUES ('$name', '$username', '$password') ";
                $result = mysqli_query($con, $sql_query);
                if ($result) {
                    $_SESSION['statusAlert'] = "Successfully Registered";
                    header("Location: admin_register.php");
                    exit();
                } else {
                    $_SESSION['statusAlert'] = "Oops Something Went Wrong...";
                    echo $con->error;
                }
            }
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
    <section class="admin_login d-flex justify-content-center" style="padding-top: 1.5rem; padding-bottom: 1rem;">
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
                    <!-- <i class="fa fa-window-close" aria-hidden="true"></i> -->
                    <!-- </div> -->
                </div>
                <h5 class="card-title text-center mb-3" style="color: #6a98b7; font-size: 2rem; font-weight: bold;">Register Form</h5>
                <form action="admin_register.php" method="post">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="name" id="myname" placeholder="Enter Your Name" required>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" name="username" id="myusername" placeholder="Enter Username" required>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" name="password" id="mypassword" placeholder="Enter Password" required>
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