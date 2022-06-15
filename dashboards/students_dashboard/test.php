<?php
include "connect.php";
for ($i = 1; $i <= 12; $i++) {
    $sql = "INSERT INTO `months` (`months`) VALUES ('$i');";
    $sql_run = mysqli_query($con, $sql);
}
if ($sql_run) {
    echo "run";
} else {
    echo "not run";
}
