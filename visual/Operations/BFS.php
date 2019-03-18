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
        // 辅助找到最路径
        $pathNodes = (new Collection)->put($this->start->toString(), new Node($this->start));

        // 初始化搜索队列, 把起点坐标存入开放队列
        // 并把起点放入关闭列表,代表已经访问过
        $this->openList->push($this->start);
        $this->closeList->put($this->start->toString(), Matrix::WALL);

        // 如果开放列表里数据不为空
        while ($this->openList->isNotEmpty()) {

            // 每次只出当前队列的个数,当后续添加的子级不会访问到
            $size = $this->openList->count();


            for ($i = 0; $i < $size; ++ $i) {

                /**
                 * 出队元素,每次都只出最前面的一个
                 * @var $currPoint Point
                 */
                $currPoint = $this->openList->shift();

                // 记录历史记录,方便前端渲染
                $this->history->push($currPoint);

                // !!! 如果当前节点等于结束节点,那么代表已经找到了终点
                if ($currPoint->eq($this->end)) {

                    /**
                     * 规划处最短路径, 并设置找到了终点
                     *
                     * @var $endNode Node
                     */
                    $endNode = $pathNodes->get($this->end->toString());
                    $this->shortestPath = $endNode->getShortestPath();
                    $this->find = true;

                    return true;
                }

                // 有多少个方向,就去往这些方向寻找
                $this->moveDirections->each(function (Point $offset) use ($currPoint, $pathNodes) {

                    // 偏移数组位置
                    $directionPoint = (clone $currPoint)->offset($offset);

                    if (
                        // 这个坐标点必须包含在矩阵里面
                        $this->matrix->contains($directionPoint) &&
                        // 且当前坐标不是墙壁,是可以行走
                        $this->matrix->get($directionPoint) != Matrix::WALL &&
                        // 并且当前坐标没有访问过,(没有加入关闭列表)
                        ! $this->closeList->has($directionPoint->toString())
                    ) {

                        // 把已经访问过的节点加入关闭列表
                        $this->closeList->put($directionPoint->toString(), Matrix::WALL);
                        // 入队,作为下一次的迭代对象
                        $this->openList->push($directionPoint);

                        // 规划最短路径
                        $pathNodes->put(
                            $directionPoint->toString(),
                            new Node($directionPoint, $pathNodes->get($currPoint->toString()))
                        );
                    }
                });

            }
        }

        return false;
    }


}
