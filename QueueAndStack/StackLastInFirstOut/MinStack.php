<?php

namespace QueueAndStack\StackLastInFirstOut\MinStack;


//    设计一个支持 push，pop，top 操作，并能在常数时间内检索到最小元素的栈。
//    
//    push(x) -- 将元素 x 推入栈中。
//    pop() -- 删除栈顶的元素。
//    top() -- 获取栈顶元素。
//    getMin() -- 检索栈中的最小元素。
//    示例:
//    
//    MinStack minStack = new MinStack();
//    minStack.push(-2);
//    minStack.push(0);
//    minStack.push(-3);
//    minStack.getMin();   --> 返回 -3.
//    minStack.pop();
//    minStack.top();      --> 返回 0.
//    minStack.getMin();   --> 返回 -2.

class MinStack
{
    protected $data;
    protected $size;
    protected $minNumber;

    public function __construct()
    {
        $this->data = [];
        $this->size = 0;
        $this->minNumber = INF;
    }

    /**
     * @param Integer $x
     * @return NULL
     */
    public function push($x)
    {
        if ($x < $this->minNumber) {

            $this->minNumber = $x;
        }

        $this->data[] = $x;
        ++ $this->size;
    }

    /**
     * @return NULL
     */
    public function pop()
    {
        if ($this->size === 0) {
            return null;
        }

        unset($this->data[$this->size - 1]);
        $this->data = array_values($this->data);
        -- $this->size;

        $this->minNumber = INF;
        for ($i = 0; $i < $this->size; ++ $i) {
            if ($this->data[$i] < $this->minNumber) {
                $this->minNumber = $this->data[$i];
            }
        }
    }

    /**
     * @return Integer
     */
    public function top()
    {
        if ($this->size === 0) {
            return -1;
        }


        return $this->data[$this->size - 1];
    }

    /**
     * @return Integer
     */
    public function getMin()
    {
        return $this->minNumber;
    }
}

return [
    ["MinStack","push","push","push","top","pop","getMin","pop","getMin","pop","push","top","getMin","push","top","getMin","pop","getMin"],
    [[],[2147483646],[2147483646],[2147483647],[],[],[],[],[],[],[2147483647],[],[],[-2147483648],[],[],[],[]],
    [null,null,null,null,2147483647,null,2147483646,null,2147483646,null,null,2147483647,2147483647,null,-2147483648,-2147483648,null,2147483647]
];
