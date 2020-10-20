<?php
function findAbsent(array $arr) : int
{
    $left = 0;
    $right = count($arr) - 1;
    while($left < $right){
        $middle = (int)floor(($right+$left)/2);
        if($arr[$middle] == $middle+1)
            $left=$middle+1;
        else
            $right=$middle-1;
    }
    return $left+1;
}

$arr = [1,2,3,4,5,6,7,8,10];
echo findAbsent($arr);

