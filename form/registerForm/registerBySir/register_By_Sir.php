<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbms";


$con = mysqli_connect($servername, $username, $password, $database);

if ($con) {
    // echo"connect";
} else {
    // echo"not connected";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        .btn {
            position: absolute;
            left: 300px;
        }

        .bg-blue {
            background-color: blue;
        }
    </style>


</head>




<body>

    <?php
    include("navbar.php");
    ?>
    <div class="container mt-4">




        <?php


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email =  $_POST['email'];
            $pass =  $_POST['password'];
            $username = $_POST['username'];
            $address = $_POST['address'];



            $sql = "INSERT INTO `regist` ( `username`, `email`, `password`, `address`) 
  VALUES ( '$username', '$email', '$pass', '$address');";

            $results = mysqli_query($con, $sql);

            echo var_dump($results);

            if ($results) {
                echo "<br>Values entered in table";
            } else {
                echo "<br>Values not entered in table";
            }

            echo '<div class="alert alert-success" role="alert">
    A simple success alert—check it out!
   </div>';
        }
        ?>




        <form action="/phptut/registration.php?" method="post">
            <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>


            <div class="mb-4">
                <label for="exampleInpuTusername1" class="form-label">username</label>
                <input type="username" class="form-control" name="username" id="username">
            </div>
            <div class="mb-4">
                <label for="exampleInputaddress1" class="form-label">address</label>
                <input type="address" class="form-control" name="address" id="address">
            </div>

    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</body>

</html>