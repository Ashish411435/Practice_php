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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome link -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <title>State List Panel</title>
</head>

<body>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $name = $_POST['name'];
        $title = $_POST['title'];
        $state = $_POST['state'];
        $year = $_POST['year'];

        $uploadFile = $_FILES['uploadFile'];
        $tmp_name = $uploadFile['tmp_name'];
        $filePath = "uploadedFiles/" . time() . $uploadFile['name'];
        move_uploaded_file($tmp_name, $filePath);

        $sql_query = "INSERT INTO `state_data` (`name`, `title`, `state`, `year`, `file`) VALUES ('$name', '$title', '$state', '$year', '$filePath')";

        $result = mysqli_query($con, $sql_query);
        if($result)
        {
            echo "Succesfully Inserted Data";
            header("location: state_list.php");
            exit;

        }
        else{
            echo $con->error;
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
                                <h2 class="text-uppercase text-center text-danger mb-5 ">Upload Files</h2>

                                <!-- Start Form -->
                                <form action="state_list.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="myName">Name : </label>
                                        <input type="text" class="form-control" id="myName" name="name" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="myTitle">Title : </label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Title" id="myTitle">
                                    </div>

                                    <label for="myTitle">Select State : </label>
                                    <select class="form-select" name="state" aria-label="Default select example">
                                        <option selected>Select State</option>

                                        <?php

                                        $sql = "SELECT * FROM `state_list`";
                                        $result = mysqli_query($con, $sql);

                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $state_name = $row['state_name'];
                                            $state_id = $row['state_id'];
                                            echo '<option value="' . $state_id . '"> ' . $state_name . '</option>';
                                        }

                                        ?>

                                    </select>
                                    <div class="form-group my-2">
                                        <label for="myYear">Year</label>
                                        <input type="number" class="form-control" name="year" id="myYear" placeholder="Enter Year">
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="myUploadFile">Upload File</label>
                                        <input type="file" class="form-control" name="uploadFile" id="myUploadFile">
                                    </div>

                                    <div class="d-flex justify-content-center my-4">
                                        <button name="submit" class="btn btn-danger btn-block btn-lg gradient-custom-4 text-body">Get</button>
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