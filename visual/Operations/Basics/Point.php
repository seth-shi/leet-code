<?php

class Point
{
    public $y;
    public $x;

    public function __construct($x = null, $y = null)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function eq(Point $point)
    {
        return $this->x == $point->x && $this->y == $point->y;
    }

    public function offset(Point $offset)
    {
        $this->x += $offset->x;
        $this->y += $offset->y;

        return $this;
    }

    public function toString()
    {
        return "$this->x,$this->y";
    }
}
