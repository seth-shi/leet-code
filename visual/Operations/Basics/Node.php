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


    public function getShortestPath()
    {
        $path = new Collection();
        $end = $this;

        while (! is_null($end)) {

            $path->push($end->point);

            $end = $end->parent;
        }

        return $path;
    }
}
