 <?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db_name = "country_select";

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
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

     <title>Sub Category Page</title>
     <style>
         * {
             box-sizing: border-box !important;
         }

         .card-width {
             width: 370px;
         }

         * {
             box-sizing: border-box !important;
         }

         .card-width {
             width: 370px;
         }

         .categoryCards {
             display: grid;
             grid-template-columns: repeat(3, auto);
             /* grid-gap: 20px; */
             justify-content: space-around;
             padding: 15px;
             margin: auto;
         }

         .categoryCards .category-card {
             border: 1px solid black;
             width: 380px;
             height: 380px;
             margin-bottom: 10px;
             border-radius: 10px;
             border-bottom-right-radius: 30%;
             text-align: center;
             padding: 10px;
             padding-top: 20px;
         }

         .categoryCards .category-card h2 {
             margin-bottom: 35px !important;
         }

         .categoryCardImage {
             width: 200px !important;
             margin: auto;
             margin-bottom: 25px !important;
             ;
         }

         .categoryCardImage img {
             border-radius: 8%;
         }
     </style>
 </head>

 <body>

     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <a class="navbar-brand font-weight-bold text-danger" href="#">Coding</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto">
                 <li class="nav-item">
                     <a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">About</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Contact Us</a>
                 </li>
             </ul>
             <form class="form-inline my-2 my-lg-0">
                 <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                 <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
             </form>
             <div class="mx-3">
                 <a href="registerForm.php" class="active"><button class="active btn btn-outline-danger btn-sm my-sm-0" type="submit">Register</button></a>
                 <a href="loginForm.php" class="mx-1"><button class="btn btn-outline-primary btn-sm my-sm-0" type="submit">Login</button></a>
             </div>

         </div>
     </nav>
     <!-- End Navigation Bar -->

     <!-- Start Cards -->

     <section class="my-5">
         <div class="categoryCards my-3">
             <?php
                $per_page_limit = 6;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $offset = ($page - 1) * $per_page_limit;

                $sql_query = "SELECT * FROM `food_register` LIMIT {$offset}, {$per_page_limit}";
                $result = mysqli_query($con, $sql_query);

                $j = 0;
                while ($row = mysqli_fetch_assoc($result)) {

                    $name = $row['name'];
                    $email = $row['email'];
                    $password = $row['password'];
                    $j++;

                    echo '<div class="category-card">
            <h2>' . $name . '</h2>
            <div class="categoryCardImage my-2">
                <img src="images/' . $password . ' " width="100%" alt="">
            </div>
            <p class="my-2"> ' . $email . '</p>
            <button class="btn btn-danger my-2" type="submit">More</button>
        </div>';
                }

                ?>
         </div>

         <!-- Start Pagination -->
         <?php
            $pagi_query = "SELECT * FROM `food_register`";
            $pagi_query_result = mysqli_query($con, $pagi_query);
            if (mysqli_num_rows($pagi_query_result)) {
                $total_record = mysqli_num_rows($pagi_query_result);
                $total_page = ceil($total_record / $per_page_limit);

                echo '<nav aria-label="...">';
                echo '<ul class="pagination justify-content-center">';
                if ($page > 1) {
                    echo '<li class="page-item">
                    <a class="page-link" href="sub_category.php?page=' . ($page - 1) . '">Previous</a>
                    </li>';
                }
                for ($i = 1; $i <= $total_page; $i++) {
                    if($page == $i){
                        $active = "active";
                    }else{
                        $active = " ";
                    }
                    echo '<li class="page-item '. $active. '"><a class="page-link" href="sub_category.php?page=' . $i . '">' . $i . '</a></li>';
                }
                if ($page < $total_page) {
                    echo '<li class="page-item">
                    <a class="page-link" href="sub_category.php?page=' . ($page + 1) . '">Next</a>
                    </li>';
                }
                echo '</ul>';
                echo ' </nav>';
            }
            ?>

     </section>
     <!-- End Cards -->




     <!-- Optional JavaScript -->
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </body>

 </html>