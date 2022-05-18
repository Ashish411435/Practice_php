<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "test_auto_dropdown";

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            /* border: 1px solid black; */
            /* width: 500px; */
            /* margin: auto; */
            text-align: center;
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <select name="category" id="category" onchange="get_subcategory()">
                <option value="">Select Category</option>
                <?php
                $sql_query = "SELECT * FROM `category`";
                $result = mysqli_query($con, $sql_query);
                while ($category_fetch = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?= $category_fetch['id'] ?>"><?= $category_fetch['category'] ?></option>
                <?php } ?>
            </select>

            <br><br>
            <select id="subcategory">
                <option selected>Select SubCategory</option>
            </select>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="jqueryFile/jquery-3.6.0.min.js"></script> -->
    <script>
        function get_subcategory(){
            var category =  $("#category").val();
            $.ajax({
                url: "getsubcategory.php",
                type: "POST",
                data: {categoryId:category},
                success: function (result){
                    $("#subcategory").html(result);
                }
            })
        }
    </script>


</body>

</html>