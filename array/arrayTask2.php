<?php

// $array = [

//     [8, 10, 20],
//     [19, 11, 18],
//     [9, 33, 5] 

// ];

// for($i = 0 ; $i < 3 ; $i++)
// {
//      $sum = 0;
//      for($j = 0 ; $j < 3 ; $j++)
//      {
//            echo $i." ".$j . " <br>";
//            $sum = $sum + $array[$i][$j];
//      }
//      echo "<h1> ".$sum." </h1> <br>";
// }
// echo "<br>";

// for($i = 0; $i < 3; $i++)
// {
//     $sum = 0;
//     for($j = 0; $j < 3; $j++)
//     {

//         $sum = $sum + $array[$j][$i];
//     }
//     echo "Adding numbers of array in column wise = " . $sum . "<br>";
// }


echo "<br>";


// Find Largest no. 2d in array

$marks = [
    [
        49, 42, 74, 63, 63, 73
    ],
    [
        47, 31, 94, 92, 84, 48
    ],
    [
        48, 93, 93, 48, 39, 49
    ]
];

for ($i = 0; $i < 3; $i++) {
    $big = $marks[$i][0];
    for ($j = 0; $j < 6; $j++) {
        if ($big < $marks[$i][$j]) {
            $big = $marks[$i][$j];
        }
    }
    echo $big;
    echo "<br>";
}
