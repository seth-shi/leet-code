<?php

class Search
{
    // 前端参数地图 map
    protected $map;
    // 开始结束节点
    protected $start;
    protected $end;
    // 访问过的节点
    protected $visited = [];

    const WALL = '1';
    const BLACK = '0';

    /**
     * 映射节点,用于协助寻找最短路径
     * @var Node[]
     */
    public $mapNode = [];
    // 历史路径,用于前端绘制
    public $history = [];
    // 最短路径
    public $shortestPath = [];
    // 是否找到终点
    public $find = false;

    public function __construct(array $map, Point $start, Point $end)
    {
        $this->visited = $this->map = $map;
        $this->start = $start;
        $this->end= $end;
    }

    public function search($allowAngle)
    {
        return true;
    }

    /**
     * @param bool $allowAngle
     * @return Point[]
     */
    protected function getOffsets($allowAngle = false)
    {
        // 上下左右的四个偏移量 上下左右
        $offset = [new Point(0, -1), new Point(0, 1), new Point(-1, 0), new Point(1, 0)];

        if ($allowAngle) {
            $offset = array_merge($offset, [new Point(1, 1), new Point(-1, -1), new Point(-1, 1), new Point(1, -1)]);
        }

        return $offset;
    }

    protected function getShortestPath(Node $end)
    {
        $path = [];

        while (! is_null($end)) {

            $path[] = $end->point;

            $end = $end->parent;
        }

        return $path;
    }
}
