<?php

class Search
{
    /**
     * @var Matrix
     */
    protected $matrix;
    // 开始结束节点
    protected $start;
    protected $end;


    /**
     * 正常情况下关闭列表是一个空数组,每次访问过加入
     * 但这样子效率太低,每次都要遍历数组是否出现这个元素
     * 现在直接初始化为矩阵参数,直接通过 key 访问
     * @var array
     */
    protected $closeList;
    // 开启关闭列表
    protected $openList;

    // 可以寻找的方向, 上下左右 + 四个斜方向 ?
    protected $moveDirections;

    // 映射节点,用于协助寻找最短路径
    protected $pathNodes;

    // 最短路径,用于前端绘制
    public $shortestPath;
    // 历史路径,用于前端绘制
    public $history;

    // 是否找到终点
    public $find = false;

    public function __construct(array $matrix, Point $startPoint, Point $endPoint, $allowAngle)
    {
        $this->matrix = new Matrix($matrix);
        $this->start = $startPoint;
        $this->end= $endPoint;

        // 上下左右的四个偏移量 上下左右
        $this->moveDirections = new Collection([new Point(0, -1), new Point(0, 1), new Point(-1, 0), new Point(1, 0)]);

        if ($allowAngle) {

            // 四个斜顶方向
            $this->moveDirections->merge([new Point(1, 1), new Point(-1, -1), new Point(-1, 1), new Point(1, -1)]);
        }


        $this->closeList = new Collection();
        $this->openList = new Collection();
        $this->pathNodes = new Collection();
        $this->history = new Collection();
        $this->shortestPath = new Collection();
    }

    public function search()
    {
        return true;
    }
}
