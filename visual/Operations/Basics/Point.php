<?php

class Point
{
    public $y;
    public $x;

    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $val) {

            if (property_exists($this, $key)) {

                $this->$key = $val;
            }
        }
    }
}
