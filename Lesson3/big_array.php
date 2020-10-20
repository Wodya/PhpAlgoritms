<?php
/**
 * Имеем массив:

[1, 12, 123, 1234, 12345, 123456, 1234567, 12345678, 123456789, 12345678910, 1234567891011...]
Объеденив все элементы массива вместе, мы получим бесконечную последовательность 11212312341234512345612345671234567812345678912345678910...
На вход метода, который Вам предстоит написать, будет подано число n, лежащее в пределах от 1 <= n <= 10**18, указывающее номер цифры в вышеупомянутом бесконечном числе. Необходимо вывести цифру, соответствующую номеру n

Примеры
$n = 1, ответ: 1
$n = 2, ответ: 1
$n = 3, ответ: 2
$n = 100, ответ: 1
$n = 2100, ответ: 2
$n = 31000, ответ: 2
$n = 999999999999999999, ответ: 4
$n = 1000000000000000000, ответ: 1
$n = 999999999999999993, ответ: 7
 */

/**
 * Сумма арифмитической прогрессии
 */
function progressionSum(int $a1, int $delta, $count)
{
    return $count * (2*$a1 + $delta*($count - 1))/2;
}

/**
 * Вычисление общей длины всех эментов в массиве [ 1, 12, 123, 1234 ... $num] = 1+2+3+4+...+length($num)
 * @param $num int Число по оси X (номер позиции)
 * @return float|int Сумма всех элементов до искомой позии
 */
function getTotalLength(int $num){
    $sum = 0;

    $lastMaxValue = 0;
    for($i=1;$i<=9;$i++)
    {
        $minNum = (int)('1' . str_repeat('0',$i-1));
        $maxNum = (int)str_repeat('9',$i);
        $count = min($num,$maxNum) - $minNum + 1;
        $a1 = $lastMaxValue==0 ? $minNum : $lastMaxValue + $i;
        $sum += progressionSum($a1,$i, $count);
        if($num <= $maxNum)
            break;
        $lastMaxValue = $a1 + ($count-1)*$i;
    }
    return $sum;
}
/**
 * Вычисление длины строки до позиции $num 123456789101112...$num
 * @param $num int Число по оси X (номер позиции) в строке
 * @return float|int Длина строки до искомой позии
 */

function getLength(int $num){
    $sum = 0;

    for($i=1;$i<=9;$i++)
    {
        $minNum = (int)('1' . str_repeat('0',$i-1));
        $maxNum = (int)str_repeat('9',$i);
        $count = min($num,$maxNum) - $minNum + 1;
        $sum += $count*$i;
        if($num <= $maxNum)
            break;
    }
    return $sum;
}

/**
 * Двоичный поиск. Ищет максимально значение X, для которого Y не превосходит $find
 * @param int $find - Что ищем по оси Y
 * @param int $right - Правая граница по оси X (левая=1)
 * @param $calcFunction - Функция вычисления Y
 * @return array Выводит максимальное X, для которого Y не превосходит $find, и сумму предыдущих Y
 */
function findBinary(int $find, int $right, $calcFunction) : array
{
    $left = 1;
    while($right-$left > 1){
        $middle = (int)floor(($right+$left)/2);
        $sum = $calcFunction($middle);
        if($sum <= $find)
            $left=$middle;
        else
            $right=$middle;
    }
    $retSum = $calcFunction($left);
    if($retSum >= $find) {
        $retSum = $calcFunction(--$left);
    }
    return  ['pos' => $left, 'sum' => $retSum];
}
function find($find)
{
    $posInArray = findBinary($find, 1000000000, 'getTotalLength');
    $findRest1 = $find - $posInArray['sum'];
    $posInString = findBinary($findRest1, $findRest1 + 2, 'getLength');
    $findRest2 = $findRest1 - $posInString['sum'];
    $found = str_split($posInString['pos'] + 1)[$findRest2 - 1];
    echo "$find => $found <BR>";
}

find(1);
find(2);
find(3);
find(100);
find(2100);
find(31000);
find(999999999999999999);
find(1000000000000000000);
find(999999999999999993);

