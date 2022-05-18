<?php
session_start();
require("db_connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <title>Add Pdf</title>
    <style>
        body {
            background: #642B73;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to left, #C6426E, #642B73);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to left, #C6426E, #642B73);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
    </style>
</head>

<body>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $category = $_POST['category'];
        $subcategory = $_POST['subcategory'];
        $title = $_POST['title'];
        $year = $_POST['year'];

        $fileName = $_FILES['file'];
        $tmp_name = $fileName['tmp_name'];
        $path = "uploaded_files/" . $fileName['name'];
        move_uploaded_file($tmp_name, $path);

        $sql = "SELECT * FROM `exam_pdf_list` WHERE name = '$title'";
        $result = mysqli_query($con, $sql);
        $row_count = mysqli_num_rows($result);
        if ($row_count > 0) {
            $_SESSION['alreadyExist'] = "Already Exist";
            header("location:add_pdf.php");
            exit;
        } else {
            $sql = "INSERT INTO `exam_pdf_list` (cat_id, sub_id, name, year, location_pdf) VALUES ('$category','$subcategory','$title', '$year', '$path');";

            $result = mysqli_query($con, $sql);

            if ($result) {
                $_SESSION['successInsert'] = "Successfully Inserted";
                header("location:add_pdf.php");
                exit;
            } else {
                // echo "<div class='alert alert-dander' role='alert'>Not Inserted...</div>";
                $_SESSION['notInsert'] = "Not Inserted";
                echo $con->error;
            }
        }
    }
    ?>

    <?php
    if (isset($_SESSION['successInsert']) == true) {
        echo '<div class="alert alert-primary" role="alert">' . $_SESSION['successInsert'] . '</div>';
        unset($_SESSION['successInsert']);
    }
    if (isset($_SESSION['alreadyExist']) == true) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['alreadyExist'] . '</div>';
        unset($_SESSION['alreadyExist']);
    }
    if (isset($_SESSION['notInsert']) == true) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['notInsert'] . '</div>';
        unset($_SESSION['notInsert']);
    }
    ?>

    <section class="vh-100">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-3">
                                <h2 class="text-uppercase text-center text-secondary mb-3 " style="border-radius: 15px; text-decoration:underline;">Add Pdf</h2>

                                <form action="add_pdf.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-outline mb-3">
                                        <label for="category" class="text-secondary font-weight-bold">Category :</label><br>
                                        <select class="form-select" name="category" id="category" onchange="get_subcategory()">
                                            <option selected>-Seclet Category-</option>
                                            <?php
                                            $sql_query = "SELECT * FROM `exam_category`";
                                            $result = mysqli_query($con, $sql_query);
                                            while ($sql_fetch = mysqli_fetch_assoc($result)) {
                                                $cat_id = $sql_fetch['id'];
                                                $cat_name = $sql_fetch['name'];
                                                echo '<option value="' . $cat_id . '">' . $cat_name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label for="subcategory" class="text-secondary font-weight-bold">SubCategory :</label>
                                        <select class="form-select" name="subcategory" id="subcategory">
                                            <option selected disabled>Select SubCategory</option>
                                        </select>
                                    </div>

                                    <!-- Start Year -->
                                    <div class="form-outline mb-3">
                                        <label for="myYear" class="text-secondary font-weight-bold">Year : </label>
                                        <select class="form-select" name="year" required id="myYear">
                                            <option selected>Select Year</option>
                                            <?php
                                            $sql = "SELECT * FROM `exam_years`";
                                            $result = mysqli_query($con, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $year = $row['year'];
                                                echo '<option value="' . $year . '"> ' . $year . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- End Year -->

                                    <div class="form-outline mb-3">
                                        <label for="myName" class="form-label text-secondary font-weight-bold">Title : </label>
                                        <input type="text" required id="title" class="form-control" name="title" placeholder="Enter Name">
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label class="form-label text-secondary font-weight-bold" for="myFile">Upload File : </label>
                                        <input type="file" required name="file" id="file" class="form-control"  >
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-dark btn-block btn-lg gradient-custom-4 " id="submitBtn">Submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        function get_subcategory() {
            var category = $("#category").val();
            $.ajax({
                url: "autoSubCategory.php",
                type: "POST",
                data: {
                    catId: category
                },
                success: function(result) {
                    $("#subcategory").html(result);
                }
            })
        }
    </script>
</body>

</html>