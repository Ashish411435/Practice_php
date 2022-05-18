<?php
$con = mysqli_connect("localhost", "root", "", "test_auto_dropdown");
if ($con) {
    // echo "successful";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <select name="cat" id="myCat">
                <option disabled selected>-Select Category-</option>
                <?php
                $sql = "SELECT * FROM `category`";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?= $row['id'] ?>"><?= $row['category'] ?></option>
                <?php
                }
                ?>
            </select>
            <br><br>
            <select name="subcat" id="mySubCat">
                <option disabled selected>-Select Sub Category-</option>
            </select>

        </div>
    </div>
    <!-- <script src="jqueryFile/j"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $("#myCat").change(function(){
        var cat = $("#myCat").val();
        $.ajax({
            url: "getsubcategory2.php",
            type: "POST",
            data: {cat:cat},
            success: function(result){
                $("#mySubCat").html(result);
            }
        })
    })
</script>
</body>

</html>