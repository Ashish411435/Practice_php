<?php

$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "examques";

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

    <title>List Of Sub Category Items</title>
</head>

<body>
    <!-- Start Category Items -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Sub Category Id</th>
                <th scope="col">Sub Category Name</th>
                <th scope="col">Category Id</th>
                <th scope="col">Delete</th>
                <th scope="col">Update</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $pagination_limit = 3;
            if(isset($_GET['page']))
            {
                $page = $_GET['page'];
            }else{
                $page = 1;
            }
            
            $offset = ($page - 1) * $pagination_limit;

            $sql_query = "SELECT * FROM `sub_category` LIMIT {$offset}, {$pagination_limit}";
            $result = mysqli_query($con, $sql_query);

            while ($row = mysqli_fetch_assoc($result)) {
                $sub_id = $row['sub_id'];
                $sub_name = $row['name'];
                $cat_id = $row['cat_id'];
            ?>
                <tr>
                    <td><?php echo $sub_id  ?></td>
                    <td><?php echo $cat_id  ?></td>
                    <td><?php echo $sub_name ?></td>
                    <td><a href="delete.php?sub_id=<?php echo $sub_id ?>" class="btn btn-danger">Delete</a></td>
                    <td><button class="btn btn-info">Update</button></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div style="display:flex; justify-content: center;">
        <?php
        $pagination_sql = "SELECT * FROM `sub_category`";
        $pagination_result = mysqli_query($con, $pagination_sql);
        if (mysqli_num_rows($pagination_result) > 0) {
            $total_record = mysqli_num_rows($pagination_result);
            $total_page = ceil($total_record / $pagination_limit);

            echo '<ul class="pagination">';
            if ($page > 1) {
                echo '<li class="page-item">
        <a class="page-link" href="items_of_sub_category.php?page=' . ($page - 1) . '" tabindex="-1">Previous</a>
    </li>';
            }
            for ($i = 1; $i < $total_page; $i++) {
                if ($i == $page) {
                    $active = "active";
                } else {
                    $active = "";
                }
                echo '<li class="page-item ' . $active . ' "><a class="page-link" href="items_of_sub_category.php?page=' . $i . '">' . $i . '</a></li>';
            }
            if ($page < $total_page) {
                echo '<li class="page-item">
                    <a class="page-link" href="items_of_sub_category.php?page=' . ($page + 1) . '" tabindex="+1">Next</a>
                 </li>';
            }
            echo '</ul>';
        }
        ?>
    </div>

    <!-- <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            
            <li class="page-item active">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li> -->
    <!-- End Category Items -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>