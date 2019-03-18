<?php

class Dijkstra
{
    protected $matrix;

    public function __construct()
    {
        //                         3
        //                 e+-----------------+
        //                 ^                  |
        //                2|                  |
        //                 |                  |
        //           1     +  1        3      |
        //      a +------> b +---> d +---+    |
        //      +                  +     |    |
        //      |                  |     v    |
        //    2 |                  |4    g <--+
        //      |                  |     ^
        //      v                  v   1 |
        //      c                  f +---+
        //      +                  ^
        //      |                  |
        //      |         2        |
        //      +------------------+

        //有向图存储
        $this->matrix = array(
            'a' => array('a' => INF, 'b' => 1,   'c' => 2,   'd' => INF, 'e' => INF, 'f' => INF, 'g' => INF),
            'b' => array('a' => INF, 'b' => INF, 'c' => INF, 'd' => 1,   'e' => 2,   'f' => INF, 'g' => INF),
            'c' => array('a' => INF, 'b' => INF, 'c' => INF, 'd' => INF, 'e' => INF, 'f' => 2, 'g' => INF),
            'd' => array('a' => INF, 'b' => INF, 'c' => INF, 'd' => INF, 'e' => INF, 'f' => 4, 'g' => 3),
            'e' => array('a' => INF, 'b' => INF, 'c' => INF, 'd' => INF, 'e' => INF, 'f' => INF, 'g' => 3),
            'f' => array('a' => INF, 'b' => INF, 'c' => INF, 'd' => INF, 'e' => INF, 'f' => INF, 'g' => 1),
            'g' => array('a' => INF, 'b' => INF, 'c' => INF, 'd' => INF, 'e' => INF, 'f' => INF, 'g' => INF),
        );
    }

    public function search()
    {
        $start = 'a';
        $end = 'g';

        // 存储路径上节点距离源点的最小距离
        $closeList = [$start => true];
        $openList = array();

        // 初始化图中节点与源点的最小距离
        foreach ($this->matrix[$start] as $key => $value) {

            // 得到各个点到源点的距离
            $openList[$key] = $value;
        }

        foreach ($this->matrix as $y => $item) {

            // 设置为初始索引,即使找不到最小值,也不会影响
            $minIndex = $start;
            $minVal = INF;


            // 找到当前行中最小的值,并选取作为优选
            foreach ($item as $x => $val) {

                // 如果此节点已经寻找过(防止回溯)
                // 如果没有找到最短路径, 并且最短距离数据的当前值更小
                // 每一次都从源点距离数据数组中取最小的出来,并且必须是还未访问过的
                if (! array_key_exists($x, $closeList) && $openList[$x] < $minVal) {

                    $minVal = $openList[$x];
                    $minIndex = $x;
                }
            }

            // 标记这个节点已经找过, 不能再倒回去找
            $closeList[$minIndex] = true;


            // 当找到最小轴之后,再去循环最小轴的那一行数据,
            // 从那一行中拿出每一个数据加上最小值和节点距离源点数组作比较
            foreach ($this->matrix[$minIndex] as $k => $v) {

                // 如果当前的这个点值加上当前轴往外扩展的距离如果更小
                if (! array_key_exists($k, $closeList) && ($minVal+$v < $openList[$k])) {

                    $openList[$k] = $minVal+$v;
                }
            }
        }

        var_dump($openList[$end]);
    }
}
