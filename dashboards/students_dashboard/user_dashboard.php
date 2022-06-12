<?php
session_start();
// Check Login Existence
if(isset($_SESSION['email']) == false){
    $_SESSION['status'] = "Something went wrong...Please Login Again.";
    header("location:login.php");
    exit();
}
if (isset($_SESSION['usertype'])) {
    $usertype = $_SESSION['usertype'];
    if ($usertype != "user") {
        $_SESSION['status'] = "! Something went wrong...Please Login Again.";
        header("location:login.php");
        exit();
    }
}

// Database connection
include "connect.php";
// Sidebar
include "sidebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="main_content_css.css">
    <title>Document</title>
</head>

<body>
    <div class="main_content">
        <?php
        require_once "navbar.php";
        ?>
        <?php
        if (isset($_SESSION['status']) == true) {
            echo '<div class="alert">' . $_SESSION['status'] . '</div>';
            unset($_SESSION['status']);
        }
        ?>
        <div class="adding_forms">

        <h2 style="color: #4968a7;">User Dashboard</h2>
        <h2 style="color: #4968a7;">Welcome <?= $_SESSION['email'] ?></h2>
            <!-- <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Add Category</h2>

                    <form action="handle.php" method="post" enctype="multipart/form-data">
                        <div style="display: flex;">
                            <div>
                                <div class="cat_name inp_div">
                                    <label for="cat_name" style="margin-bottom: 10px;">* Category Name : </label>
                                    <div>
                                        <input type="text" name="cat_name" id="cat_name">
                                    </div>
                                </div>
                                <div class="description inp_div">
                                    <label for="description" style="margin-bottom: 10px;">* Description : </label>
                                    <div>
                                        <textarea name="description" id="description" cols="40" rows="1" style="border: none;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="offer inp_div">
                                    <label for="offer" style="margin-bottom: 10px;">Offer : </label>
                                    <div>
                                        <input type="text" name="offer" id="offer">
                                    </div>
                                </div>
                                <div class="cat_img inp_div">
                                    <label for="cat_img">* Category Image : </label>
                                    <div>
                                        <input type="file" name="cat_img" id="cat_img">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="add_btn inp_div">
                            <button type="submit" class="btn btn-primary" name="cat_submit">Add</button>
                        </div>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
</body>

</html>