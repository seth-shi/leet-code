<?php


class DFS extends Search
{

    protected $yLength;
    protected $xLength;

    /**
     * 广度优先搜索
     *
     * @param $allowAngle
     * @return bool
     */
    public function search($allowAngle)
    {
        $this->yLength = count($this->map);
        $this->xLength = count($this->map[0]);

        $offsets = $this->getOffsets($allowAngle);

        // 初始化最短路径节点
        $parentNode = null;

        try {

            $this->DFSSearch($this->start, $offsets);

        } catch (Exception $e) {
            return true;
        }



        return true;
    }


    public function DFSSearch(Point $point, $offsets, $parentNode = null)
    {
        // 如果超过了边界,或者当前的值不是岛屿,那么退出
        if (
            $point->x < 0 ||
            $point->x == $this->xLength ||
            $point->y < 0 ||
            $point->y == $this->yLength ||
            $this->visited[$point->y][$point->x] == Search::WALL
        ) {
            return;
        }

        // 存储找过的节点
        $this->history[] = $point;
        // 是否已经有这个节点
        if (! array_key_exists($point->toString(), $this->mapNode)) {

            $this->mapNode[$point->toString()] = new Node($point, $parentNode);
        }
        $mapNode = $this->mapNode[$point->toString()];

        // 如果找到了终点
        if ($point->x == $this->end->x && $point->y == $this->end->y) {

            $this->shortestPath = $this->getShortestPath($mapNode);
            $this->find = true;

            throw new Exception('找到解答');
        }

        // 代表已经读取过了
        $this->visited[$point->y][$point->x] = Search::WALL;

        // 上下左右的遍历
        foreach ($offsets as $p) {

            $offsetPoint = new Point($point->x + $p->x, $point->y + $p->y);
            $this->DFSSearch($offsetPoint, $offsets, $mapNode);
        }
    }

}
