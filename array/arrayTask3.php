<?php

// 1. Sum of Even numbers in all arrays
// 2. Total sum of even-numbers of all arrays
// 3. Numbers are less than 50 
$data = [
    [48, 48, 19, 34],
    [34, 34, 34, 54],
    [53, 62, 51, 61],
    [50, 42, 51, 31]
];



$total_even_sum = 0;
for($i = 0; $i < 4; $i++)
{
    $add_even_no = 0; 
    for($j = 0; $j < 4; $j++)
    {
        if($data[$i][$j] % 2 == 0)
        {
            $add_even_no = $add_even_no + $data[$i][$j];
        }
    }
   echo "Sum of even number = " . $add_even_no . "<br>"; 
   $total_even_sum = $total_even_sum + $add_even_no;
}
echo "Total Sum of even numbers = " . $total_even_sum;




// $total_even_sum = 0;
// $count = 0;
// $add = 0;
// for ($i = 0; $i < 4; $i++) {
//     for ($j = 0; $j < 4; $j++) {
//         if ($data[$i][$j] % 2 == 0) {
//             $add = $add + $data[$i][$j];
//         }
//         if ($data[$i][$j] < 50) {
//             $count = $count + 1;
//         }
//     }
//     echo "Sum Of Even Numbers = $add <br>";
//     $total_even_sum = $total_even_sum + $add;
// }

// echo "Total Sum Of Even Numbers = $total_even_sum <br>";
// echo "Count Numbers Less Than 50 = $count <br>";
