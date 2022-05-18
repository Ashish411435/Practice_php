<?php

require_once("db_connection.php");
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Register</title>
</head>

<body>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $confirmPassword = $_POST['confirmPwd'];

    if($password == $confirmPassword)
    {
        $hash_pwd = md5($password);
        $sql_query = "INSERT INTO `state_register` (fullname, email, password) VALUES ('$name', '$email', '$hash_pwd')";
        $result = mysqli_query($con , $sql_query);
        if($result)
        {
            echo "successfuly inserted";
        }
        else{
            echo "not inserted";
        }
    }
    else{
        echo '<div class="alert alert-danger" role="alert"> Your Password Does not Match </div>';
    }

}

?>

    <div class="container py-5">
        <section class="vh-100 bg-image pb-5" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-4">
                                    <h2 class="text-uppercase text-center text-success mb-5">Create an account</h2>

                                    <form action="register.php" method="POST">

                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="myName">Full Name :</label>
                                            <input type="text" name="name" id="myName" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="myEmail">Your Email :</label>
                                            <input type="email" name="email" id="myEmail" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="mypwd">Password :</label>
                                            <input type="password" name="pwd" id="mypwd" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="myConfPwd">Confirm your password :</label>
                                            <input type="password" name="confirmPwd" id="myConfPwd" class="form-control form-control-lg" />
                                        </div>

                                        <div class="d-flex justify-content-center mt-4">
                                            <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                        </div>

                                        <p class="text-center text-muted mt-4 mb-0">Have already an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>