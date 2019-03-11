<?php

class Matrix
{
    // 方块
    const WALL = '1';
    const BLACK = '0';

    protected $data;
    protected $width;
    protected $height;

    public function __construct(array $data)
    {
        $this->data = $data;

        $this->height = count($data);
        $this->width = count($data[0] ?? []);
    }


    public function topMargin()
    {
        return 0;
    }

    public function bottomMargin()
    {
        return $this->height - 1;
    }

    public function leftMargin()
    {
        return 0;
    }

    public function rightMargin()
    {
        return $this->width - 1;
    }


    public function get($x, $y)
    {
        return $this->data[$y][$x] ?? null;
    }
}
