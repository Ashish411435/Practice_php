<?php
/* Delete Query For Category*/
require("db_connection.php");
// $cat_id = $_GET['id'];

// $sql_query_delete = "DELETE FROM `exam_category` WHERE `id` = $cat_id";
// $result_delete = mysqli_query($con, $sql_query_delete);
// if($result_delete)
// {
//     header("location:items_of_category.php");
//     exit;
// }else{
//     echo $con->error;
// }


/* For SubCategory */
if(isset($_GET['id'])){
    $sub_id = $_GET['sub_id'];

    $sql_query_delete = "DELETE FROM `sub_category` WHERE sub_id = '$sub_id';";
    $result_delete = mysqli_query($con, $sql_query_delete);
    
    if($result_delete)
    {
        echo "Deleted";
        header("location:items_of_sub_category.php");
        exit;
    }else{
        echo $con->error;
    }
}




?>