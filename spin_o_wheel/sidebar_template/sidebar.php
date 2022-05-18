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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
        .accordion .accordion-item .accordion-button:hover{
            color: #DF6589FF !important;
            color: purple !important;
        }
        .accordion_hover a{
            border-bottom: 1px solid rgb(161, 189, 218);
        }
        .accordion_hover a:hover{
            color: purple !important;
            text-decoration: none !important;
        }

    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white text-center" id="sidebar-wrapper"
            style="background-color: #8BC6EC; background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
            <div class="text-center my-2">
                <!-- <div style="margin: auto; border: 1px solid black;"> -->
                <i class="fa fa-user-o" style="background-color: #9599E2; color: white; padding: 25px 29px; font-size: 1.2rem; border-radius: 50%;" aria-hidden="true"></i>
                <!-- <i class="fa fa-window-close" aria-hidden="true"></i> -->
                <!-- </div> -->
            </div>
            <div class="sidebar-heading border-bottom text-center"
                style="background-color: #8BC6EC; background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%); color: rgb(102, 102, 184); padding: 20px 20px; padding-top: 10px; font-weight: bold; font-family: cursive; font-size: 1.4rem;">
                Admin Dashboard</div>
            <div class="list-group list-group-flush">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item"
                        style="background-color: #8BC6EC; background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button text-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                style="background-color: #8BC6EC; background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%); font-size: 20px; font-weight: bold; padding-left: 2.5rem;">
                                Add Slots
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="navbar-nav" style="padding: 0; margin: 0;">
                                    <li class="nav-item accordion_hover"><a href="#" class="nav-link text-light">Add Money</a></li>
                                    <li class="nav-item accordion_hover"><a href="#" class="nav-link text-light">Add Coins</a></li>
                                    <li class="nav-item accordion_hover"><a href="#" class="nav-link text-light">Add Offers</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed text-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo"
                                style="background-color: #8BC6EC; background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%); font-size: 20px; font-weight: bold; padding-left: 2rem;">
                                Register List
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed text-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree"
                                style="background-color: #8BC6EC; background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%); font-size: 20px; font-weight: bold; padding-left: 2rem;">
                                Winner List
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom"
                style="background-color: #8BC6EC; background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);">
                <div class="container-fluid">
                    <button class="btn text-light" id="sidebarToggle" style="background-color: #9599E2;"><i class="fa fa-bars" aria-hidden="true" style="font-size: 20px;"></i></button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item active accordion_hover" style="border: none;"><a class="nav-link text-light font-weight-bold"
                                    href="#!">Home</a></li>
                            <li class="nav-item logout_btn accordion_hover"><a class="nav-link text-light font-weight-bold"
                                    href="#!">Logout</a></li>
                            <!-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-light" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Action</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Something else here</a>
                                    </div>
                                </li> -->
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid">
                
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
