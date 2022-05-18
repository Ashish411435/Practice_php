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
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql_query = "SELECT * FROM `admin_register` WHERE `username` = '$username' && `password` = '$password'";
        $result = mysqli_query($con, $sql_query);
        $row_count = mysqli_num_rows($result);
        $row_name = mysqli_fetch_assoc($result);
        $name = $row_name['name'];
        if ($row_count > 0) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $username;
            header("Location: add_slots.php");
            exit;
        } else {
            $_SESSION['invalidAlert'] = "Invalid Username or Password...";
            header("Location: admin_login.php");
            exit;
        }
    }
    ?>

    <?php
    if (isset($_SESSION['invalidAlert'])) {
        echo '<div class="alert alert-warning" role="alert">' . $_SESSION['invalidAlert'] . '</div>';
        unset($_SESSION['invalidAlert']);
    }
    ?>

    <!-- Login Form -->
    <section class="admin_login d-flex justify-content-center" style="padding-top: 4rem; padding-bottom:2rem;">
        <div>
            <div class="col-12 my-4 text-center">
                <a href="admin_register.php"><button class="btn btn-block btn-lg" style="background-color: #6a98b7; color: white; padding:10px; font-weight:bold;">Register</button></a>
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
                <h5 class="card-title text-center mb-4" style="color: #6a98b7; font-size: 2rem; font-weight: bold;">Admin
                    Login</h5>
                <form action="admin_login.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="username" id="myusername" placeholder="Username" required>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" id="mypassword" placeholder="Password" required>
                    </div>
                    <div class="my-2" style="text-align: right;">
                        <a href="forgotPassword.php" style="color: #6a98b7;">Forgot Password</a>
                    </div>
                    <div class="col-12 my-4 text-center">
                        <button class="btn btn-block btn-lg" style="background-color: #6a98b7; color: white; padding:10px; font-weight:bold;" type="submit">Login</button>
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