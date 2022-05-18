<?php

$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "food";

// Begin Connection 
$con = mysqli_connect("$hostname", "$username", "$password", "$db_name");

// To Check Connection
if ($con) {
    // echo "Connection Successful";
} else {
    // echo "Connection not Sucessful";
}
/*--- End Conncetion --- */

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

    <title>category Panel</title>
</head>

<body>


    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];

        $img = $_FILES['imageName'];
        $tmp_name = $img['tmp_name'];
        $folder = "cat_uploaded/" . $img['name'];
        move_uploaded_file($tmp_name, $folder);

        $sql = "INSERT INTO `exam_category` (name, description, img_path) VALUES ('$name','$description','$folder');";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo "<div class='alert alert-success' role='alert'>Successfully Inserted</div>";
            header("location: category_panel.php");
            exit;
        } else {
            // echo "Result Failed";
            echo "<div class='alert alert-dander' role='alert'>Not Inserted...</div>";
        }


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
                                <h2 class="text-uppercase text-center text-danger mb-5 ">Category Upload Form</h2>

                                <!-- Start Form -->
                                <form action="category_panel.php" onsubmit="return formSubmit()" method="post" enctype="multipart/form-data">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="myName">Name : </label>
                                        <input type="text" id="myName" class="form-control form-control-lg" name="name" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="mydescription">Description</label>
                                        <textarea name="description" id="mydescription" class="form-control form-control-lg" cols="30" rows="10"></textarea>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="myImg">Image</label>
                                        <input type="file" id="myImg" class="form-control form-control-lg" name="imageName" />
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-danger btn-block btn-lg gradient-custom-4 text-body">Submit</button>
                                    </div>
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