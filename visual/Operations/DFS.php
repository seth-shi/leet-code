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


    /**
     * @param Point $point
     * @param null  $parentNode
     * @throws Exception
     */
    public function DFSSearch(Point $point, $parentNode = null)
    {
        // 如果超过了边界,或者当前的值不是岛屿,那么退出
        if (
            $point->x < $this->matrix->leftMargin() ||
            $point->x > $this->matrix->rightMargin() ||
            $point->y < $this->matrix->topMargin() ||
            $point->y > $this->matrix->bottomMargin() ||
            // 或者当前坐标点是墙壁
            $this->matrix->get($point) == Matrix::WALL ||
            // 或者当前坐标点已经访问过(加入了关闭列表)
            $this->closeList->has($point->toString())
        ) {
            return;
        }


        // 存储找过的节点
        $this->history->push($point);

        /**
         * @var $endNode Node
         * 如果已经存在了这个节点,那么直接获取这个节点即可
         * 防止重复设置父节点
         */
        $endNode = new Node($point, $parentNode);

        // 如果找到了终点
        if ($point->eq($this->end)) {

            $this->shortestPath = $endNode->getShortestPath();
            $this->find = true;

            throw new Exception('找到解答');
        }

        // 代表已经读取过了
        $this->closeList->put($point->toString(), Matrix::WALL);

        // 上下左右的遍历
        $this->moveDirections->each(function (Point $movePoint) use ($point, $endNode) {

            $newNode = (clone $point)->offset($movePoint->x, $movePoint->y);

            $this->DFSSearch($newNode, $endNode);
        });
    }

}
