<?php


class BFS extends Search
{


    /**
     * 广度优先搜索
     *
     * @param $allowAngle
     * @return bool
     */
    public function search($allowAngle)
    {
        $yLength = count($this->map);
        $xLength = count($this->map[0]);

        $offsets = $this->getOffsets($allowAngle);

        // 初始化搜索队列
        $queue = [$this->start->toString()];
        // 初始化最短路径节点
        $parentNode = null;

        // 如果队列里数据不为空
        while (! empty($queue)) {

            // 出队元素,并转化成为坐标对象
            $firstPoint = Point::stringNewInstance(array_shift($queue));

            // 记录历史记录,方便前端渲染
            $this->history[] = $firstPoint;

            // 是否已经有这个节点
            if (! array_key_exists($firstPoint->toString(), $this->mapNode)) {

                $this->mapNode[$firstPoint->toString()] = new Node($firstPoint, $parentNode);
            }
            $mapNode = $this->mapNode[$firstPoint->toString()];


            if ($firstPoint->x == $this->end->x && $firstPoint->y == $this->end->y) {

                // 把最后一个元素弹出,因为那已经是终点了
                array_pop($this->history);

                $this->shortestPath = $this->getShortestPath($mapNode);

                return true;
            }

            // 这条数据去其他方向寻找
            foreach ($offsets as $p) {

                $offsetPoint = new Point($firstPoint->x + $p->x, $firstPoint->y + $p->y);

                if (
                    $offsetPoint->x >= 0 &&
                    $offsetPoint->x < $xLength &&
                    $offsetPoint->y >= 0 &&
                    $offsetPoint->y < $yLength &&
                    $this->visited[$offsetPoint->y][$offsetPoint->x] != Search::WALL
                ) {

                    $this->mapNode[$offsetPoint->toString()] = new Node($offsetPoint, $mapNode);

                    $this->visited[$offsetPoint->y][$offsetPoint->x] = Search::WALL;
                    // 入队,作为下一次的迭代对象
                    $queue[] = $offsetPoint->toString();
                }
            }
        }

        return false;
    }


}
