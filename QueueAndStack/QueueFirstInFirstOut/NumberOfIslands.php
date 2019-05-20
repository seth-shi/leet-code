<?php

namespace QueueAndStack\QueueFirstInFirstOut\NumberOfIslands;

//    给定一个由 '1'（陆地）和 '0'（水）组成的的二维网格，计算岛屿的数量。一个岛被水包围，并且它是通过水平方向或垂直方向上相邻的陆地连接而成的。你可以假设网格的四个边均被水包围。
//
//    示例 1:
//
//    输入:
//    11110
//    11010
//    11000
//    00000
//
//    输出: 1
//    示例 2:
//
//    输入:
//    11000
//    11000
//    00100
//    00011
//
//    输出: 3

class Solution
{
    protected $xLength;
    protected $yLength;
    protected $visited;
    protected $index = 0;

    /**
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid)
    {
        $this->visited = $grid;
        $this->yLength = count($grid);
        if (0 === $this->yLength) {
            return -1;
        }

        $this->xLength = count($grid[0]);
        $lands = 0;

        for ($y = 0; $y < $this->yLength; ++$y) {

            for ($x = 0; $x < $this->xLength; ++$x) {

                // 如果当前这个值为 1, 且没有被遍历过,那么就算岛屿
                if ($this->visited[$y][$x] == '1') {

                    ++$lands;
                    $this->visited[$y][$x] = 0;
                    $this->BFS($x, $y);
                }
            }
        }

        return $lands;
    }

    /**
     * 使用广度优先算法,每次迭代一个层级直到不顾和条件
     * 假设岛屿是这样
     * 1 1 0 0 0
     * 1 1 1 1 0
     * 1 0 1 0 0
     * 1 0 0 0 1
     *
     * 那么 DFS 搜索的顺序是这样(假设递归的顺序是↑↓←→
     * (总是先往同一个方向发展,直到尽头,然后尽头节点的第二个方向)
     * (先后的顺序取决于代码中先递归哪一个方向)
     * 1 6 0 0 0
     * 2 5 7 9 0
     * 3 0 8 0 0
     * 4 0 0 0 1
     *
     * BFS 的搜索顺序则是(假设迭代的顺序是↑↓←→
     * 1 3 0 0 0
     * 2 5 7 9 0
     * 4 0 8 0 0
     * 6 0 0 0 1
     *
     * @param $x
     * @param $y
     */
    protected function BFS($x, $y)
    {
        $offset = [0, 1, 0, -1, 0];

        // 待处理队列
        $q = ["{$y}:{$x}"];
        while (! empty($q)) {

            $first = array_shift($q);
            list($y, $x) = array_map('intval', explode(':', $first));

            // 取到上下左右四个
            for ($i = 0; $i < 4; ++$i) {

                $currX = $x+$offset[$i];
                $currY = $y+$offset[$i + 1];

                if (
                    $currX >= 0 &&
                    $currX < $this->xLength &&
                    $currY >= 0 &&
                    $currY < $this->yLength &&
                    $this->visited[$currY][$currX] == '1'
                ) {

                    $this->visited[$currY][$currX] = '0';
                    $q[] = "{$currY}:{$currX}";
                }

            }
        }

    }
}

return [
    ['Solution', 'numIslands'],
    [[null], [[["1", "1", "1", "1", "0"], ["1", "1", "0", "1", "0"], ["1", "1", "0", "0", "0"], ["0", "0", "0", "0", "0"]]]],
    [null, 1]
];
