<?php


class BFS extends Search
{


    /**
     * 广度优先搜索
     */
    public function search()
    {


        $yLength = count($this->map);
        $xLength = count($this->map[0]);

        $offset = [0, 1, 0, -1, 0];
        $queue = [$this->start->x.':'.$this->start->y];

        // 如果队列里数据不为空
        while (! empty($queue)) {

            $first = array_shift($queue);
            list($x, $y) = array_map('intval', explode(':', $first));

            if ($x == $this->end->x && $y == $this->end->y) {

                return true;
            }

            // 记录历史记录,方便前端渲染
            $this->history[] = new Point(compact('x', 'y'));

            // 这条数据去其他方向寻找
            for ($i = 0; $i < 4; ++$i) {

                $currX = $x+$offset[$i];
                $currY = $y+$offset[$i + 1];

                if (
                    $currX >= 0 &&
                    $currX < $xLength &&
                    $currY >= 0 &&
                    $currY < $yLength &&
                    $this->visited[$currY][$currX] != Search::WALL
                ) {

                    $this->visited[$currY][$currX] = Search::WALL;
                    $queue[] = "{$currX}:{$currY}";
                }

            }
        }

        return false;
    }


}
