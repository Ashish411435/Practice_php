<?php

// date_add(date_interval_create_from_date_string());
// date_create(date());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
if (isset($_POST['I_get'])) {

    // if ($_SERVER['REQUEST_METHOD'] = "POST") {
    $year = $_POST['year'];
    $month = $_POST['month'];


    $duration = $year . $month;

    $joinDate = $_POST['joinDate'];
    print_r($joinDate);
    // exit();
    // die();
    $jd = date_create($joinDate);
    date_add($jd, date_interval_create_from_date_string($duration));
    $joinDate = date_format($jd, 'd-m-Y');
    echo $joinDate;

    // echo $jd;

    // $endDate = $_POST['endDate'];
    // }
}
?>

<body>
    <form action="test.php" method="POST">
        Duration :
        <select name="year" id="year">
            <option disabled selected>-Select year-</option>
            <option value="1 year">1</option>
            <option value="2 year">2</option>
            <option value="3 year">3</option>
            <option value="4 year">4</option>
            <option value="5 year">5</option>
        </select>     
        <select name="month" id="month">
            <option disabled selected>-Select Month-</option>
            <option value="1 Months">1</option>
            <option value="2 Months">2</option>
            <option value="3 Months">3</option>
            <option value="4 Months">4</option>
            <option value="5 Months">5</option>
            <option value="6 Months">6</option>
            <option value="7 Months">7</option>
            <option value="8 Months">8</option>
            <option value="9 Months">9</option>
            <option value="10 Months">10</option>
            <option value="11 Months">11</option>
            <option value="12 Months">12</option>
        </select>     
        <br>
        Join : <input type="date" name="joinDate" id="joinDate"><br/>
        <!-- End : <input type="text" name="endDate" id="endDate"><br /> -->
        <button type="submit" name="I_get">Get</button>
    </form>
</body>

</html>