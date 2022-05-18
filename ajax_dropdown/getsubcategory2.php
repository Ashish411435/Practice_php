<?php
$con = mysqli_connect("localhost", "root", "", "test_auto_dropdown");

$category = $_POST['cat'];
$sql = "SELECT * FROM `sub_category` WHERE cat_id = '$category'";
$result = mysqli_query($con, $sql);
?>

<select>
    <option selected disabled>Select SubCategory</option>
    <?php
    while($row = mysqli_fetch_assoc($result)) { ?>
    <option value="<?= $row['id']?>"><?= $row['subcategory']?></option>
<?php } ?>
</select>