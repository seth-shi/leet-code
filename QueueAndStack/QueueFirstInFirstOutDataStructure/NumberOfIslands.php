<?php

namespace QueueAndStack\QueueFirstInFirstOutDataStructure\NumberOfIslands;

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
    protected $readMap = [];

    protected $yLength;
    protected $xLength;
    protected $grid;

    /**
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid)
    {
        $this->yLength = count($grid);

        if (0 === $this->yLength) {
            return 0;
        }

        $this->xLength = count($grid[0]);
        $this->grid = $grid;
        $lands = 0;

        for ($y = 0; $y < $this->yLength; ++ $y) {

            for ($x = 0; $x < $this->xLength; ++ $x) {

                // 如果当前这个值为 1, 且没有被遍历过,那么就算岛屿
                if ($this->grid[$y][$x] == 1 && ! $this->isRead($x, $y)) {
                    ++ $lands;
                    $this->findLand($x, $y);
                }
            }
        }

        return $lands;
    }

    protected function findLand($x, $y)
    {
        // 如果不是岛屿,也提前退出
        if ($this->grid[$y][$x] == 0) {
            return;
        }

        if ($this->isRead($x, $y)) {
            return;
        }


        // 读取过了
        $this->readMap[$y][$x] = true;

        // 寻找当前节点的上下左右放入队列
        if (0 !== $y) {
            $this->findLand($x, $y - 1);
        }
        if (($this->yLength - 1) !== $y) {
            $this->findLand($x, $y + 1);
        }

        if (0 !== $x) {
            $this->findLand($x - 1, $y);
        }
        if (($this->xLength - 1) !== $x) {
            $this->findLand($x + 1, $y);
        }
    }

    protected function isRead($x, $y)
    {
        $is = $this->readMap[$y][$x] ?? false;

        // 如果已经遍历过了,可以取消这个
        return $is;
    }
}

return [
    ['Solution', 'numIslands'],
    [[null], [[["1","1","1","1","0"],["1","1","0","1","0"],["1","1","0","0","0"],["0","0","0","0","0"]]]],
    [null, 1]
];
