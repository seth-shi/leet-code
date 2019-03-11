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


    /**
     * 把坐标点换成对象
     * @param $xy
     * @return Point
     */
    public static function newInstanceByString($xy)
    {
        list($x, $y) = array_map('intval', explode(':', $xy));

        return new self($x, $y);
    }

    public function eq(Point $point)
    {
        return $this->x == $point->x && $this->y == $point->y;
    }

    public function offset($x, $y)
    {
        $this->x += $x;
        $this->y += $y;

        return $this;
    }

    public function toString()
    {
        return "$this->x:$this->y";
    }
}
