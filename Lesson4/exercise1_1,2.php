<?php
// 1. Удаление ноды
// 2. Обход деревьев LNR, LRN, NLR
/**
 * Class Node
 * Node $left
 * Node $right
 */
class Node{
    public $value;
    public $left;
    public $right;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

/**
 * Class Tree
 * Node $root;
 */
class Tree{
    public $root;

    public function Add(int $value){
        $node = new Node($value);
        $this->AddNode($node, $this->root);
    }
    private function AddNode(Node $node, ?Node &$sub){
        if($sub === null)
            $sub = $node;
        else if($node->value < $sub->value)
            $this->AddNode($node, $sub->left);
        else
            $this->AddNode($node, $sub->right);
    }

    public function TraversNLR()
    {
        if($this->root != null)
            $this->TraversNLRInternal($this->root);
    }
    public function TraversNLRInternal(?Node $node)
    {
        if($node == null)
            return;
        echo $node->value . '&nbsp';
        $this->TraversNLRInternal($node->left);
        $this->TraversNLRInternal($node->right);
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
        echo $node->value . '&nbsp';
        $this->TraversLNRInternal($node->right);
    }
    public function TraversLRN()
    {
        if($this->root != null)
            $this->TraversLRNInternal($this->root);
    }
    public function TraversLRNInternal(?Node $node)
    {
        if($node == null)
            return;
        $this->TraversLRNInternal($node->left);
        $this->TraversLRNInternal($node->right);
        echo $node->value . '&nbsp';
    }
    public function FindNode($value) : array
    {
        if($this->root != null)
            return $this->FindNodeInternal($value, $this->root, null);
    }
    private function FindNodeInternal($value, ?Node $node, ?Node $parentNode) : array
    {
        if($node === null)
            return ["node" => null,"parent" => null];
        if($value === $node->value)
            return ["node" => $node,"parent" => $parentNode];
        if($value < $node->value)
            return$this->FindNodeInternal($value, $node->left, $node);
        else
            return$this->FindNodeInternal($value, $node->right, $node);
    }
    private function findMin(Node $node, Node $parentNode) : array
    {
        return $node->left != null ? $this->findMin($node->left, $node) :  ["node" => $node, "parent" => $parentNode];
    }
    private function ReplaceNode(Node $parentNode, Node $toReplace, ?Node $replace, bool $copyReference) : void
    {
        if($parentNode->left === $toReplace)
            $parentNode->left = $replace;
        else
            $parentNode->right = $replace;
        if(!$copyReference || $replace === null)
            return;
        $replace->left = $toReplace->left;
        $replace->right = $toReplace->right;
    }
    public function DeleteNode($value)
    {
        $nodeArray = $this->FindNode($value);
        $node = $nodeArray["node"];
        $parentNode = $nodeArray["parent"];
        if($nodeArray["node"] === null)
            throw new Exception('Значение не найдено');
        if($node->left === null)
            $this->ReplaceNode($parentNode, $node, $node->right, false);
        elseif ($node->right === null)
            $this->ReplaceNode($parentNode, $node, $node->left, false);
        else{
            $findArray = $this->findMin($node->right, $node);
            $this->ReplaceNode($parentNode, $node, $findArray["node"], true);
            $this->ReplaceNode($findArray["parent"], $findArray["node"], null, false);
        }
    }
}

$tree = new Tree();
$tree->Add(10);
$tree->Add(1);
$tree->Add(6);
$tree->Add(16);
$tree->Add(19);
$tree->Add(14);
$tree->Add(5);
$tree->Add(8);
$tree->Add(7);
$tree->Add(9);
$tree->Add(4);

$tree->TraversNLR();
echo '<BR>';
$tree->TraversLNR();
echo '<BR>';
$tree->TraversLRN();
echo '<BR><BR>';
echo 'Удаление<BR>';
$tree->DeleteNode(1);
$tree->TraversNLR();
echo '<BR>';
$tree->DeleteNode(6);
$tree->TraversNLR();
