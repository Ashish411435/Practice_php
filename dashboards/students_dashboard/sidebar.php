<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Box icon link -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom Css link -->
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
    <style>

    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxl-audible'></i>
                <div class="logo_name"><span>AshCode</span></div>
            </div>
            <i class='bx bx-menu' id="menuBtn"></i>
        </div>
        <ul class="nav_list">
            <li class="searchBtn" style="margin-bottom: 5px;">
                <i class='bx bx-search-alt-2'></i>
                <input type="search" name="search" id="search" placeholder="Search...">
            </li>
            <?php
            if (isset($_SESSION['usertype'])) {
                $usertype = $_SESSION['usertype'];
                if ($usertype == "admin") {
                    $redirect_to_dashboard = "admin_dashboard.php";
                } else if ($usertype == "user") {
                    $redirect_to_dashboard = "user_dashboard.php";
                }
            }
            if (isset($_SESSION['email'])) {
            ?>
                <li>
                    <a href="<?php echo $redirect_to_dashboard ?>">
                        <i class="bx bxl-discord-alt"></i><span class="list_name">Dashboard</span>
                        <span class="tooltip">Dashboard</span>
                    </a>
                </li>
                <?php
                if ($usertype == "admin") { ?>
                    <li>
                        <a href="create_user.php">
                            <i class="bx bxs-user-circle"></i><span class="list_name">User</span>
                            <span class="tooltip">User</span>
                        </a>
                    </li>
                <?php } ?>
                <li>
                    <a href="add_student.php">
                        <i class="bx bx-user-plus"></i><span class="list_name">Student</span>
                        <span class="tooltip">Student</span>
                    </a>
                </li>
                <li>
                    <a href="#;">
                        <i class="bx bxl-angular"></i><span class="list_name">Attendence</span>
                        <span class="tooltip">Attendence</span>
                    </a>
                </li>
                <li>
                    <a href="#;">
                        <i class="bx bx-log-out-circle"></i><span class="list_name">Logout</span>
                        <span class="tooltip">Logout</span>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        var menuBtn = document.getElementById("menuBtn");
        var sidebar = document.querySelector(".sidebar");
        var searchBtn = document.querySelector(".bx-search-alt-2");

        searchBtn.addEventListener("click", showMenu);
        menuBtn.addEventListener("click", showMenu);

        function showMenu() {
            sidebar.classList.toggle("active");
        }
    </script>
</body>

</html>