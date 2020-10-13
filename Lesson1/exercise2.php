<?php
$num = 600851475143;
$divider = [];

$start = microtime(true);
while(true){
    $count = 2;
    while ($num % $count != 0 && $num > $count)
        $count++;
    $divider[] = $count;
    if($num == $count)
        break;
    $num /= $count;
}
ksort($divider);
echo 'Максимальный простой делитель = ' . $divider[count($divider) - 1] . '<BR>';
echo 'Время ' . sprintf("%.9f", (microtime(true) - $start) / 100000) . 'с';
var_dump($divider);
