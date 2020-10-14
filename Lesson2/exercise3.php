<?php

$spiral = new Spiral();
$spiral->makeSpiral(8,6);
$spiral->printArray();


class Spiral{
    private $rowMin = 0;
    private $rowMax;
    private $colMin = 0;
    private $colMax;

    private $num = 0;
    private $arr = [];

    function makeSpiral(int $rows, int $cols) : array
    {
        if($rows <= 0 || $cols <= 0)
            throw new \http\Exception\InvalidArgumentException();

        $this->rowMax = $rows - 1;
        $this->colMax = $cols - 1;
        while ($this->makeColDown() && $this->makeRowRight() && $this->makeColUp() && $this->makeRowLeft());
        return $this->arr;
    }

    function makeColDown() : bool
    {
        for($i=$this->rowMin;$i<=$this->rowMax;$i++){
            $this->arr[$i][$this->colMin] = ++$this->num;
        }
        $this->colMin++;
        return $this->checkBounds();
    }
    function makeColUp() : bool
    {
        for($i=$this->rowMax;$i>=$this->rowMin;$i--){
            $this->arr[$i][$this->colMax] = ++$this->num;
        }
        $this->colMax--;
        return $this->checkBounds();
    }
    function makeRowRight() : bool
    {
        for($i=$this->colMin;$i<=$this->colMax;$i++){
            $this->arr[$this->rowMax][$i] = ++$this->num;
        }
        $this->rowMax--;
        return $this->checkBounds();
    }
    function makeRowLeft() : bool
    {
        for($i=$this->colMax;$i>=$this->colMin;$i--){
            $this->arr[$this->rowMin][$i] = ++$this->num;
        }
        $this->rowMin++;
        return $this->checkBounds();
    }
    function checkBounds()
    {
        return $this->rowMin <= $this->rowMax && $this->colMin <= $this->colMax;
    }
    function printArray()
    {
        $elementSize = 4;
        echo '<p style="font-family: monospace;">';
        for ($i=0;$i<count($this->arr);$i++) {
            for ($j = 0; $j < count($this->arr[$i]); $j++) {
                echo $this->arr[$i][$j] . str_repeat('&nbsp', $elementSize - strlen($this->arr[$i][$j])) ;
            }
            echo '<BR>';
        }
        echo '</p>';
    }
}



