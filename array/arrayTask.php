<?php
$arr = [ 89, 35 ,2, 70, 31];
// Sum of all Number inside Array
$sum = 0;
for($i = 0; $i < 5; $i++)
{
    $sum = $sum + $arr[$i];
}
echo "Sum of Array = " . $sum;

echo "<br>";

// sum of even numbers
$even = 0;  
for($j = 0; $j < 5; $j++)
{
    if($arr[$j] % 2 == 0)
    {
        $even = $even + $arr[$j];
    }
}
echo "Sum of Even Number in Array = " .  $even;

echo "<br>";

// Sum of Odd Number in Array
$odd = 0; 
for($o = 0; $o < 5; $o++)
{
    if($arr[$o] % 2 != 0)
    {
        $odd = $odd + $arr[$o];
    }
}
echo "Sum of Odd numbers in array = " . $odd;
echo "<br>";

// Sum of Numbers in array but skip numbers 1 - 20
$add = 0;
for($i = 0; $i < 5; $i++)
{
    if(($arr[$i] >= 0 && $arr[$i] <= 20) == false)
    {
        $add = $add + $arr[$i];
    }
}
echo "Sum of number Above 20 = " . $add;

echo "<br>";


// Finding Larger number in array
$large = $arr[0];
for($i = 0; $i < 5; $i++)
{
    if($large < $arr[$i])
    {
        $large = $arr[$i];
    }
}
echo "Larger number in array = " . $large;

echo "<br>";

// Finding smaller number in array
$small = $arr[0];
for($i = 0; $i < 5; $i++)
{
    if($small > $arr[$i])
    {
        $small = $arr[$i];
    }
}
echo "Smaller number in array = " . $small;

echo "<br>";

//  Finding odd smaller number
$odd_small = $arr[0];
for($j = 0; $j < 5; $j++)
{
    if($arr[$j] % 2 != 0){
        if($odd_small > $arr[$j])
        {
            $odd_small = $arr[$j];
        }
    }
}
echo "Odd Smaller Number = " . $odd_small;

echo "<br>";

// Finding the numbers in array less than 50

$count = 0;
for($i = 0; $i < 5; $i++)
{
    if($arr[$i] < 50)
    {
        $count = $count + 1;
    }
}
echo "Number of counts less than 50 = " . $count;

?>