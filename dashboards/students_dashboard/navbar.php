<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        a {
            text-decoration: none;
            color: #4e6599;
        }

        /* Begin Navigation Bar */
        .navbar {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            padding: 3px;
            display: flex;
            /* justify-content: right; */
            color: #4e6599;
        }


        .navbar .logo {
            /* border: 1px solid black; */
            width: calc(100%/12*3);
            padding: 0 10px;
            padding-right: 20px;
            display: flex;
            align-items: center;
            padding-left: 50px;
            border-radius: 0px 20px 20px;
            color: #4e6599;
        }

        .sidebar .logo_content .logo:hover {
            background-color: rgb(48, 51, 62);
            border-radius: 20px;
        }

        .navbar .logo i {
            font-size: 50px;
            margin-right: 1%;
            line-height: 50px;
        }

        .navbar .logo span {
            font-size: 27px;
            font-weight: bold;
        }

        .navbar .user {
            /* border: 1px solid black; */
            width: calc(100% / 12 * 9);
            display: flex;
            justify-content: right;
            align-items: center;
            gap: 10px;
            padding: 5px;
            color: #4e6599;
            border-radius: 0px 20px 20px;
        }

        .navbar .user .user_name {
            /* border: 1px solid red; */
            position: relative;
            /* margin: 0px 3px; */
            display: flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 10px;
            box-shadow: rgba(161, 160, 160, 0.2) 0px 2px 8px 0px;
        }

        .navbar .user .user_name:hover {
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            cursor: pointer;
        }

        .navbar .user .user_icon {
            width: 50px;
            border-radius: 50%;
            font-size: 20px;
            padding: 10px 5px;
            color: #3e517e;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
        }

        .navbar .user p {
            color: #4e6599;
            font-size: 13px;
            line-height: 20px;
            text-decoration: underline;
            text-align: center;
        }

        .navbar .user .navBtn {
            /* border: 1px solid red; */
            padding: 0 5px;
            border-radius: 0px 20px 20px;
            color: #4e6599;
            display: flex;
            align-items: center;
        }

        .navbar .user .navBtn a {
            margin: 0 2px;
        }

        .navbar .user .navBtn i {
            font-size: 12px;
        }

        .navbar .user .navBtn .btn {
            width: 100%;
            padding: 7px 15px;
            border-radius: 20px;
            border: none;
            background: #809bdc;
            background: -webkit-linear-gradient(to right, #294378, #617dbe);
            background: linear-gradient(to right, #1f3b73, #7390db);
            color: white;
            font-size: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .navbar .user .navBtn .btn:hover {
            background: #809bdc;
            background: -webkit-linear-gradient(to right, #294378, #617dbe);
            background: linear-gradient(to right, #8ba9f4, #1f3b73);
            box-shadow: inset 3px 0px 0.5px 1px;
        }

        /* End Navigation Bar */
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <a href="dashboard.php"><i class='bx bxl-audible'></i></a>
            <a href="dashboard.php">
                <div class="logo_name"><span>AshCode</span></div>
            </a>
        </div>
        <div class="user">
            <div class="user_name">
                <div class="user_icon">
                    <i class='bx bxs-user'></i>
                </div>
                <div>
                    <h5 style="text-align:center;"><?php if (isset($_SESSION['usertype'])) {
                                                        echo $_SESSION['usertype'];
                                                    } ?> </h5>
                    <p><?php if (isset($_SESSION['username'])) {
                            echo $_SESSION['username'];
                        } ?>
                    </p>
                </div>
            </div>
            <?php
            if (!isset($_SESSION['email'])) {
                echo '<div class="navBtn">
                <a href="register.php"><button class="btn">Register</button></a>
                <a href="login.php"><button class="btn">Login</button></a>
                </div>';
            }
            ?>
            <?php
            if (isset($_SESSION['email'])) {
                echo '
                <form action="handle.php" method="POST">
                    <a class="navBtn"><button class="btn" name="logout_btn"><i class="bx bx-log-out-circle"></i> Logout</button></a>
                </form>
                ';
            } ?>
        </div>


    </div>

    <script>
        var user = document.querySelector(".user");
        var logout_btn = document.querySelector(".logout_btn");

        user.addEventListener("click", show);

        function show() {
            logout_btn.classList.toggle("show_logoutbtn");
        }
        // window.onclick = function(event) {
        //     if (event.target == logout_btn) {
        //         logout_btn.style.display = "none";
        //     }
        // }
    </script>
</body>

</html>