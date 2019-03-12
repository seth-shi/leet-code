<?php


class Dijkstra extends Search
{
    protected $distance = 10;

    /**
     * 迪杰斯特拉算法
     *
     * @return bool
     */
    public function search()
    {
        // 辅助找到最路径
        $mapPathNodes = new Collection();
        // 初始化搜索队列
        $this->openList->push($this->start->toString());

        // 如果开放列表里数据不为空
        while ($this->openList->isNotEmpty()) {

            // 出队开放列表的元素,并转化成为坐标对象
            $headPoint = Point::newInstanceByString($this->openList->shift());

            // 记录历史记录,方便前端渲染
            $this->history->push($headPoint);

            /**
             * @var $endNode Node
             * 如果已经存在了这个节点,那么直接获取这个节点即可
             * 防止重复设置父节点
             */
            $endNode = $mapPathNodes->remember($headPoint->toString(), new Node($headPoint, null));

            // !!! 如果当前节点等于结束节点,那么代表已经找到了终点
            if ($headPoint->eq($this->end)) {

                // 规划处最短路径, 并设置找到了终点
                $this->shortestPath = $endNode->getShortestPath();
                $this->find = true;

                return true;
            }

            // BFS 在这里是有多少个方向,就去往这些方向寻找
            // Dijkstra 选择暂时最短最优的路线,动态规划
            $this->moveDirections->each(function (Point $offset) use ($headPoint) {

                $newPoint = $headPoint->offset($offset);

                if (
                    $this->matrix->contains($newPoint) &&
                    ! $this->closeList->has($newPoint->toString()) &&
                    // 而且这个距离更短
                    false
                ) {

                }

            });

        }


        return false;
    }


}
