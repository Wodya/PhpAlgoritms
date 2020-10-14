<?php
$start = hrtime(true);
set_time_limit(900);
getSequenceNum(1);
getSequenceNum(2);
getSequenceNum(3);
getSequenceNum(100);
getSequenceNum(2100);
getSequenceNum(31000);
getSequenceNum(999999999999999999);
getSequenceNum(1000000000000000000);
getSequenceNum(999999999999999993);
echo 'Время ' . sprintf("%.9f", (hrtime(true) - $start) / 1e9) . 'с';

function getSequenceNum(int $posNum) : int
{
    // 1 , 12, 123, 1234, 12345
    // 1 , 2,  3,   4,    5 ....

    //Находим в какой элемент массива попадает индекс
    for($sum=0, $element = 1, $elementNum = 1 ;$sum+$element<$posNum; $sum += $element, $element+= strlen($elementNum+1), $elementNum++);
    $localPos = $posNum - $sum;

    //Находим символ в строке элемента массива
    for($i=1;$localPos > strlen($i); $localPos -= strlen($i),$i++);

    $ret = str_split($i)[$localPos-1];
    echo "$posNum => $ret <br>";
    return $ret;
}
