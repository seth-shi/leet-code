<?php


class BFS extends Search
{


    /**
     * 广度优先搜索
     *
     * @return bool
     */
    public function search()
    {
        // 初始化搜索队列
        $this->openList = new Collection($this->start->toString());
        // 辅助找到最路径
        $mapPathNodes = new Collection();

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

            // 有多少个方向,就去往这些方向寻找
            $this->moveDirections->each(function (Point $movePoint) use ($headPoint, $endNode, $mapPathNodes) {

                $newPoint = (clone $headPoint)->offset($movePoint->x, $movePoint->y);

                // 这个子坐标点必须不能超过四个边界
                // 而且不能是已经访问过的(加入了关闭列表)
                if (
                    $newPoint->x >= $this->matrix->leftMargin() &&
                    $newPoint->x <= $this->matrix->rightMargin() &&
                    $newPoint->y >= $this->matrix->topMargin() &&
                    $newPoint->y <= $this->matrix->bottomMargin() &&
                    // 且当前坐标不是墙壁,是可以行走
                    $this->matrix->get($newPoint) != Matrix::WALL &&
                    // 并且当前坐标没有访问过,(没有加入关闭列表)
                    ! $this->closeList->has($newPoint->toString())
                ) {

                    // 设置当前节点的儿子节点
                    $mapPathNodes->put($newPoint->toString(), new Node($newPoint, $endNode));

                    // 把已经访问过的节点加入关闭列表
                    $this->closeList->put($newPoint->toString(), Matrix::WALL);

                    // 入队,作为下一次的迭代对象
                    $this->openList->push($newPoint->toString());
                }
            });

        }

        return false;
    }


}
