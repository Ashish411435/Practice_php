<?php
// Database connection
include "connect.php";

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="main_content_css.css">
    <link rel="stylesheet" href="style.css">

    <!-- Box icon link -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>Document</title>
    <style>
        .main_content {
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
        }

        .main_content .adding_forms .card {
            position: absolute;
            width: 23rem;
        }
    </style>
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
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Register</h2>

                    <form action="handle.php" method="post" enctype="multipart/form-data">
                        <div>
                            <div class="username inp_div">
                                <label for="name" style="margin-bottom: 10px;">* Enter Your Name : </label>
                                <div>
                                    <input type="text" name="name" id="name">
                                </div>
                            </div>
                            <div class="mobile inp_div">
                                <label for="mobile" style="margin-bottom: 10px;">* Enter Mobile Number : </label>
                                <div>
                                    <input type="tel" name="mobile" id="mobile">
                                </div>
                            </div>
                            <div class="email inp_div">
                                <label for="email" style="margin-bottom: 10px;">* Enter Email Address : </label>
                                <div>
                                    <input type="email" name="email" id="email">
                                </div>
                            </div>
                            <div class="password inp_div">
                                <label for="password" style="margin-bottom: 10px;">* Enter Password : </label>
                                <div>
                                    <input type="text" name="password" id="password">
                                </div>
                            </div>
                        </div>
                        <div class="add_btn inp_div">
                            <button type="submit" class="btn" name="register_form">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    session_destroy();
    session_abort();
    ?>
</body>

</html>