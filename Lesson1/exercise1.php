<?php
$strings = ['((a + b)/ c) - 2', "([ошибка)", '"(")'];
$results = [];
$testChars = [')' => '(', ']' => '[', '}' => '{'];

foreach ($strings as $str){
    $stack = new SplStack();
    foreach (str_split($str) as $char){
        if($stack->valid() && $stack->top() == '"') {
            if($char == '"')
                $stack->pop();
            continue;
        }
        if($char == '"') {
            $stack->push($char);
            continue;
        }
        if( in_array($char,$testChars))
            $stack->push($char);
        if( key_exists($char,$testChars)) {
            if($testChars[$char] != $stack->top())
                break;
            $stack->pop();
        }
    }
    $results[] = $stack->isEmpty();
}
for($i=0;$i<count($strings);$i++){
    echo $strings[$i] . ' => ' . ($results[$i] ? 'Правильно' : 'Ошибка') . '<BR>';
}
var_dump($results);