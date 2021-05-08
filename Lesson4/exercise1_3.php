<?php
// Обратная польская нотация через графы
/**
 * Class Node
 * Node $left
 * Node $right
 * array $numbers
 * int $priority
 */
class Node{
    public $operand;
    public $left;
    public $right;
    public $numbers;
    public $priority;

    public function __construct($operand, $priority)
    {
        $this->operand = $operand;
        $this->priority = $priority;
    }
}

/**
 * Class Tree
 * Node $root;
 * int $priority;
 * int $value
 */
class Tree{
    public $root;

    public function Add(string $operand, int $priority){
        $node = new Node($operand, $priority);
        $this->AddNode($node, $this->root);
        return $node;
    }
    public static function Compare(Node $node1, Node $node2) : bool
    {
        if($node1->priority != $node2->priority)
            return $node1->priority > $node2->priority;
        $opPriority1 = in_array($node1->operand, ['+','-'])?0:1;
        $opPriority2 = in_array($node2->operand, ['+','-'])?0:1;
        return $opPriority1 >= $opPriority2;
    }
    private function AddNode(Node $node, ?Node &$sub){
        if($sub === null)
            $sub = $node;
        else if(static::Compare($sub, $node))
            $this->AddNode($node, $sub->right);
        else
            $this->AddNode($node, $sub->left);
    }
    public function TraversLNR()
    {
        if($this->root != null)
            $this->TraversLNRInternal($this->root);
    }
    public function TraversLNRInternal(?Node $node)
    {
        if($node == null)
            return;
        $this->TraversLNRInternal($node->left);
        if($node->numbers !== null)
            echo implode(' ',$node->numbers) . ' ';
        echo $node->operand . '&nbsp';
        $this->TraversLNRInternal($node->right);
    }
}
function PolishNotation(string $formulaStr)
{
    //Все операции с меньшим или равным приоритетом идут направо от текущей, а с большим налево. Числа вписываем в ноду. Потом используем обход LNR
    $formula = str_split($formulaStr);
    $number = 0;
    $priority = 0;
    $tree = new Tree();
    $lastNode = null;
    for ($pos = 0; $pos < count($formula); $pos++) {
        $char = $formula[$pos];
        if ($char === ' ')
            continue;
        if (is_numeric($char))
            $number = $char;
        else {
            if ($char === '(')
                $priority++;
            elseif ($char === ')') {
                $priority--;
                if ($number !== null && $lastNode !== null)
                    $lastNode->numbers[] = $number;
                $lastNode = null;
                $number = null;
            } else {
                $node = $tree->Add($char, $priority);
                if ($number !== null) {
                    if ($lastNode !== null && Tree::Compare($lastNode, $node))
                        $lastNode->numbers[] = $number;
                    else
                        $node->numbers[] = $number;
                    $number = null;
                }
                $lastNode = $node;
            }
        }
    }
    if ($number !== null && $lastNode !== null)
        $lastNode->numbers[] = $number;

    $tree->TraversLNR();
    echo '<BR>';
}

PolishNotation('6 + 9*(5 + 6) + 8');
PolishNotation('1*2 + 3*4');
PolishNotation('1 + 2*3');
PolishNotation('1 + 2*(3+4)');
PolishNotation('1 + (2+3)*4');
PolishNotation('(1+2)*(3+4)');




