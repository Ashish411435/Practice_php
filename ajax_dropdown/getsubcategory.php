<?php
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

$category = $_POST['categoryId'];
$sql_query = "SELECT * FROM `sub_category` WHERE cat_id = '$category'";
$result = mysqli_query($con, $sql_query);
?>
<select>
    <option disabled selected>-Select SubCategory- </option>
    <?php
    while ($sql_fetch = mysqli_fetch_assoc($result)) { ?>
        <option value=" <?= $sql_fetch['id'] ?>"> <?= $sql_fetch['subcategory'] ?></option>
    <?php } ?>
</select>