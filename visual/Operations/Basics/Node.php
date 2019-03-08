<?php

class Node
{

    public $point;
    public $parent;

    public function __construct(Point $point, Node $parent = null)
    {
        $this->point = $point;
        $this->parent = $parent;
    }
}
