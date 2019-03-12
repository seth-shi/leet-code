<?php

class Matrix
{
    // 墙壁
    const WALL = 0;

    protected $data;
    protected $width;
    protected $height;

    public function __construct(array $data)
    {
        $this->data = $data;

        $this->height = count($data);
        $this->width = count($data[0] ?? []);
    }

    /**
     * 判断这个坐标点是否包含在矩阵里面
     * @param Point $p
     * @return bool
     */
    public function contains(Point $p)
    {
        return
            $p->x >= $this->leftMargin() &&
            $p->x <= $this->rightMargin() &&
            $p->y >= $this->topMargin() &&
            $p->y <= $this->bottomMargin();
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


    public function get(Point $p)
    {
        return $this->data[$p->y][$p->x] ?? null;
    }
}
