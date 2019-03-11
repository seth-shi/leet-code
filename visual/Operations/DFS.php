<?php


class DFS extends Search
{

    protected $yLength;
    protected $xLength;

    /**
     * 广度优先搜索
     *
     * @return bool
     */
    public function search()
    {
        try {

            $this->DFSSearch($this->start);

        } catch (Exception $e) {

        }

        return true;
    }


    public function DFSSearch(Point $point, $parentNode = null)
    {
        // 如果超过了边界,或者当前的值不是岛屿,那么退出
        if (
            $point->x < 0 ||
            $point->x == $this->matrixWidth ||
            $point->y < 0 ||
            $point->y == $this->matrixHeight ||
            $this->closeList[$point->y][$point->x] == Search::WALL
        ) {
            return;
        }

        // 存储找过的节点
        $this->history[] = $point;

        // 是否已经有这个节点
        if (! array_key_exists($point->toString(), $this->pathNodes)) {

            $this->pathNodes[$point->toString()] = new Node($point, $parentNode);
        }
        $pathNodes = $this->pathNodes[$point->toString()];

        // 如果找到了终点
        if ($point->eq($this->end)) {

            $this->shortestPath = $this->getShortestPath($pathNodes);
            $this->find = true;

            throw new Exception('找到解答');
        }

        // 代表已经读取过了
        $this->closeList[$point->y][$point->x] = Search::WALL;

        // 上下左右的遍历
        foreach ($this->moveDirections as $moveNode) {

            $newNode = $point->offset($moveNode->x, $moveNode->y);
            $this->DFSSearch($newNode, $pathNodes);
        }
    }

}
