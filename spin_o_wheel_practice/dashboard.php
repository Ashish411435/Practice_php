<?php
require("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Simple Sidebar - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <!-- Bootstrap Css Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Google Fonts Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />

    <style>
        * {
            font-family: 'Ubuntu', sans-serif;
        }

        body {
            background-color: #e1f1fc;
        }

        .accordion .accordion-item .accordion-button:hover {
            color: #DF6589FF !important;
            color: purple !important;
        }

        .accordion_hover a {
            border-bottom: 1px solid rgb(161, 189, 218);
        }

        .accordion_hover a:hover {
            color: purple !important;
            text-decoration: none !important;
        }

        .sidebar_list a:hover {
            color: rgb(102, 102, 184) !important;
            background-color: #8BC6EC;
            background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);
        }

        .active {
            color: rgb(102, 102, 184) !important;
            background-color: #8BC6EC;
            background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);
            border: none;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <?php
        if($_SERVER['REQUEST_METHOD'] = 'POST'){
            $addmoney = $_POST['addmoney'];
            $addcoin = $_POST['addcoin'];
            $addoffer = $_POST['addoffer'];

            $sql_query = "SELECT * FROM `add_slots` where `money` = '$addmoney'";
        }
    ?>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white text-center" id="sidebar-wrapper" style="background-color: #8BC6EC; background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
            <div class="text-center my-2">
                <i class="fa fa-user-o" style="background-color: #9599E2; color: white; padding: 22px 26px; font-size: 1.2rem; font-weight: bold; border-radius: 50%;" aria-hidden="true"></i>
            </div>
            <div class="sidebar-heading border-bottom text-center" style="background-color: #76b6e1; color: white; padding-top: 5px; padding-bottom: 30px; font-weight: bold; font-family: cursive; font-size: 1.2rem;">
                Admin Dashboard
            </div>
            <div class="list-group list-group-flush sidebar_list text-center" style="background-color: #8BC6EC; background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
                <a class="list-group-item list-group-item-action list-group-item-light p-3 active" style="background-color: skyblue; color:white;" href="#!">Add Slots</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 " style="background-color: skyblue; color:white;" href="#!">Register List</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 " style="background-color: skyblue; color:white;" href="#!">Winner List</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 " style="background-color: skyblue; color:white;" href="#!">Transaction</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 " style="background-color: skyblue; color:white;" href="#!">Wallet</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" style="background-color: #8BC6EC; background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
                <div class="container-fluid">
                    <!-- Start Bar Icon -->
                    <button class="btn text-light" id="sidebarToggle" style="background-color: #6a98b7;"><i class="fa fa-bars" aria-hidden="true" style="font-size: 20px;"></i></button>
                    <!-- End Bar Icon -->

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item accordion_hover" style="border: none;"><a class="nav-link text-light font-weight-bold" href="#!">Home</a></li>
                            <li class="nav-item logout_btn accordion_hover"><a class="nav-link text-light font-weight-bold" href="#!">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page content-->
            <div class="container-fluid">
                <section class="admin_login d-flex justify-content-center" style="padding-top: 3rem; padding-bottom: 1.5rem;">
                    <div class="card" style="width: 27rem; padding: 0px 20px; border-radius: 20px;">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-4" style="color: #6a98b7; font-size: 2rem; font-weight: bold;"><u>Add Slots</u></h5>
                            <form action="admin_login.php" method="post">
                                <div class="mb-3">
                                    <label for="myaddmoney" class="form-label">Add Money :</label>
                                    <input type="text" name="addmoney" class="form-control" id="myaddmoney" placeholder="Enter Amount" required>
                                </div>
                                <div class="mb-3">
                                    <label for="myaddcoin" class="form-label">Add Coins :</label>
                                    <input type="text" name="addcoin" class="form-control" id="myaddcoin" placeholder="Enter Coins" required>
                                </div>
                                <div class="mb-3">
                                    <label for="myaddoffer" class="form-label">Add Offer :</label>
                                    <input type="text" name="addoffer" class="form-control" id="myaddoffer" placeholder="Enter offer" required>
                                </div>
                                <div class="col-12 my-4 text-center">
                                    <button class="btn btn-block" style="background-color: #6a98b7; color: white; padding:10px; font-weight:bold;" type="submit">Submit</button>
                                </div>
                                <!-- <a href="#" class="btn btn-primary">Login</a> -->
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>