<?php
function getRandomArray(int $size, int $max) : array
{
    $arr=[];
    for ($i=0;$i<$size;$i++)
        $arr[] = random_int(1, $max);
    return $arr;
}
function sortArray($arr1, $arr2) : array
{
    $outArray = [];
    $p1 = 0;
    $p2 = 0;
    while( $p1 < count($arr1) && $p2 < count($arr2)) {
        if ($arr1[$p1] < $arr2[$p2]) {
            $outArray[] = $arr1[$p1];
            $p1++;
        } else {
            $outArray[] = $arr2[$p2];
            $p2++;
        }
    }
    while ($p1 < count($arr1))
        $outArray[] = $arr1[$p1++];
    while ($p2 < count($arr2))
        $outArray[] = $arr2[$p2++];
    return $outArray;
}
function mergeSort($arr) : array
{
    do{
        $outArray = [];
        for($i=0;$i<count($arr);$i+=2){
            $arr1 = is_array($arr[$i]) ? $arr[$i] : [$arr[$i]];
            if($i+1 < count($arr))
                $arr2 = is_array($arr[$i+1]) ? $arr[$i+1] : [$arr[$i+1]];
            else
                $arr2 = [];
          $outArray[] = sortArray($arr1, $arr2);
        }
        $arr = $outArray;
    }
    while(count($arr) > 1);

    return $outArray[0];
}

//$arr = [5,4,3,2,1];
$arr = getRandomArray(10,100);
echo implode(',', $arr) . '<BR>' . implode(',', mergeSort($arr));



