<?php
/*
 * Быстрая сортировка методом Хоара
 * Весёлая анимация
 * https://forkettle.ru/vidioteka/programmirovanie-i-set/108-algoritmy-i-struktury-dannykh/sortirovka-i-poisk-dlya-chajnikov/1010-metod-khoara-bystraya-sortirovka-quick-sort
 */
function getRandomArray(int $size, int $max) : array
{
    $arr=[];
    for ($i=0;$i<$size;$i++)
        $arr[] = random_int(1, $max);
    return $arr;
}
function quickSort(&$arr, int $left=0, int $right=null)
{
    if($right === null){
        $right = count($arr) - 1;
    }

    if($left >= $right)
        return;
    $cl = $left;
    $cr = $right;
    $d = 1;
    while ($cl < $cr)
    {
        while($arr[$cl]<=$arr[$cr] && $cl<$cr)
        {
            $cl += ($d+1)%2;
            $cr -= $d;
        }
         if($cl >= $cr)
            break;

         swap($arr,$cl,$cr);
         $d = ($d+1) %2;
    }
    if($left < $cl)
        quickSort($arr, $left, $cl - 1);
    if($cr < $right)
        quickSort($arr, $cr + 1, $right);

}
function swap(&$arr,$x,$y)
{
    $tmp = $arr[$x];
    $arr[$x] = $arr[$y];
    $arr[$y] = $tmp;
}
$arr = getRandomArray(10,100);
file_put_contents("C:\Temp\QuickSort.txt",implode(',',$arr));
//$arr = [3,0,1,8,7,2,5,4,9,6];
//$arr = [2,72,77,45,25,40,80,25,32,29];
quickSort($arr);
var_dump($arr);
