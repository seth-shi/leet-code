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

    public static function mapNewInstance(array $attributes)
    {
        $instance = new self();

        foreach ($attributes as $key => $val) {

            if (property_exists($instance, $key)) {

                $instance->$key = $val;
            }
        }

        return $instance;
    }

    public static function stringNewInstance($xy)
    {
        list($x, $y) = array_map('intval', explode(':', $xy));

        return new self($x, $y);
    }


    public function toString()
    {
        return "$this->x:$this->y";
    }
}
