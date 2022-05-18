<?php

require("db_connection.php");

$category = $_POST['catId'];
$sql = "SELECT * FROM `sub_category` WHERE `cat_id` = '$category'";
$result = mysqli_query($con, $sql);

?>
<select>
    <option disabled selected>-Select SubCategory-</option>
    <?php
    while ($sql_fetch = mysqli_fetch_assoc($result)) { ?>
        <option value="<?= $sql_fetch['sub_id'] ?>"><?= $sql_fetch['name'] ?></option>
    <?php } ?>  

</select>