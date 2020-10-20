<?php
function findBinaryMin(array $arr, int $find) : int
{
    $left = 0;
    $right = count($arr) - 1;
    while($left < $right){
        $middle = (int)floor(($right+$left)/2);
        if($arr[$middle] < $find)
            $left=$middle+1;
        else
            $right=$middle-1;
    }
    return $arr[$left]==$find? $left : $left+1;
}
function findBinaryMax(array $arr, int $find) : int
{
    $left = 0;
    $right = count($arr) - 1;
    while($left < $right){
        $middle = (int)floor(($right+$left)/2);
        if($arr[$middle] <= $find)
            $left=$middle+1;
        else
            $right=$middle-1;
    }
    return $arr[$right]==$find? $right : $right-1;
}
function findRepeat(array $arr, int $find)
{
    $left = findBinaryMin($arr,$find) + 1;
    $right = findBinaryMax($arr,$find) + 1;

    echo '[' . implode($arr,',') . ']';
    if($left > $right) {
        echo ". Число $find не найдено<BR>";
    }
    else {
        $repeat = $right-$left+1;
        echo ". Число $find. Повторений = $repeat c $left по $right <BR>";
    }
}

findRepeat([2,3,3,4,4,5,5],4);
findRepeat([4,4,4,4,4,4,4],4);
findRepeat([2,3,3,4,4,5,5],1);
findRepeat([2,3,3,4,4],4);
findRepeat([4,4,5,5,6,7],4);
findRepeat([4,5,5,6,7],4);
findRepeat([1,2,2,4,5,5,6,7],4);
