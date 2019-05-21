<?php

namespace QueueAndStack\QueueFirstInFirstOut\DesignCircularQueue;

//    设计你的循环队列实现。 循环队列是一种线性数据结构，其操作表现基于 FIFO（先进先出）原则并且队尾被连接在队首之后以形成一个循环。它也被称为“环形缓冲器”。
//
//    循环队列的一个好处是我们可以利用这个队列之前用过的空间。在一个普通队列里，一旦一个队列满了，我们就不能插入下一个元素，即使在队列前面仍有空间。但是使用循环队列，我们能使用这些空间去存储新的值。
//
//    你的实现应该支持如下操作：
//
//    MyCircularQueue(k): 构造器，设置队列长度为 k 。
//    Front: 从队首获取元素。如果队列为空，返回 -1 。
//    Rear: 获取队尾元素。如果队列为空，返回 -1 。
//    enQueue(value): 向循环队列插入一个元素。如果成功插入则返回真。
//    deQueue(): 从循环队列中删除一个元素。如果成功删除则返回真。
//    isEmpty(): 检查循环队列是否为空。
//    isFull(): 检查循环队列是否已满。

class MyCircularQueue
{
    protected $data;

    protected $originSize = 0;
    protected $size;

    // 当值进入, back 即可变为 0,使两个指向同一个元素
    protected $back = -1;
    protected $front = 0;


    public function __construct($k)
    {
        $this->data = array_fill(0, $k, null);
        $this->size = $k;
    }


    public function enQueue($value)
    {
        // 队列是否已经装满
        if ($this->isFull()) {
            return false;
        }

        ++$this->originSize;
        // 判断队列是否超越了边界
        // 先移动再操作数组坐标
        $this->back = ($this->back == $this->size-1) ? 0 : $this->back+1;
        $this->data[$this->back] = $value;

        return true;
    }


    public function deQueue()
    {
        if ($this->isEmpty()) {
            return false;
        }

        --$this->originSize;
        // 先操作坐标值,再移动
        $this->data[$this->front] = null;
        $this->front = ($this->front == $this->size-1) ? 0 : $this->front+1;

        return true;
    }


    public function Front()
    {
        if ($this->isEmpty()) {
            return -1;
        }

        return $this->data[$this->front];
    }


    public function Rear()
    {
        if ($this->isEmpty()) {
            return -1;
        }

        return $this->data[$this->back];
    }


    public function isEmpty()
    {
        return 0 === $this->originSize;
    }


    public function isFull()
    {
        return $this->size === $this->originSize;
    }
}
