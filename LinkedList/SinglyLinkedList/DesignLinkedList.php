<?php

//    设计链表的实现。您可以选择使用单链表或双链表。单链表中的节点应该具有两个属性：val 和 next。val 是当前节点的值，next 是指向下一个节点的指针/引用。如果要使用双向链表，则还需要一个属性 prev 以指示链表中的上一个节点。假设链表中的所有节点都是 0-index 的。
//
//    在链表类中实现这些功能：
//
//    get(index)：获取链表中第 index 个节点的值。如果索引无效，则返回-1。
//    addAtHead(val)：在链表的第一个元素之前添加一个值为 val 的节点。插入后，新节点将成为链表的第一个节点。
//    addAtTail(val)：将值为 val 的节点追加到链表的最后一个元素。
//    addAtIndex(index,val)：在链表中的第 index 个节点之前添加值为 val  的节点。如果 index 等于链表的长度，则该节点将附加到链表的末尾。如果 index 大于链表长度，则不会插入节点。
//    deleteAtIndex(index)：如果索引 index 有效，则删除链表中的第 index 个节点。

class Node
{
    public $next;
    public $val;

    public function __construct(int $value)
    {
        $this->val = $value;
    }
}

class MyLinkedList
{
    protected $head;

    /**
     * 取链表中第 index 个节点的值。
     * 如果索引无效，则返回-1。
     *
     * @param $index
     * @return int
     */
    public function get($index)
    {
        $node = $this->head;

        $i = 0;
        while (! is_null($node)) {

            if ($i === $index) {
                return $node->val;
            }

            // 节点走入下一步
            ++ $i;
            $node = $node->next;
        }

        return -1;
    }

    /**
     * 在链表的第一个元素之前添加一个值为 val 的节点。插入后，
     * 新节点将成为链表的第一个节点。
     *
     * @param $val
     */
    public function addAtHead($val)
    {
        $node = new Node($val);

        $node->next = $this->head;
        $this->head = $node;
    }


    /**
     * 将值为 val 的节点追加到链表的最后一个元素。
     *
     * @param $val
     */
    public function addAtTail($val)
    {
        $node = new Node($val);

        // 如果链表没有头结点,未存入值
        // 那么直接使头节点等于新节点
        if (is_null($this->head)) {
            $this->head = $node;
            return;
        }


        $head = $this->head;
        while (true) {

            if (is_null($head->next)) {

                $head->next = $node;
                break;
            }

            $head = $head->next;
        }
    }


    /**
     * 在链表中的第 index 个节点之前添加值为 val  的节点。
     * 如果 index 等于链表的长度，则该节点将附加到链表的末尾。
     * 如果 index 大于链表长度，则不会插入节点。
     *
     * @param $index
     * @param $val
     */
    public function addAtIndex($index, $val)
    {
        if ($index === 0) {

            $this->addAtHead($val);
            return;
        }

        $newNode = new Node($val);
        $head = $this->head;
        $i = 1;

        while (! is_null($head)) {

            if ($i === $index) {

                $newNode->next = $head->next;
                $head->next = $newNode;
                break;
            }

            ++ $i;
            $head = $head->next;
        }

    }

    /**
     * 如果索引 index 有效，则删除链表中的第 index 个节点。
     *
     * @param $index
     */
    public function deleteAtIndex($index)
    {
        if (is_null($this->head)) {

            return;
        }

        if ($index === 0) {

            $this->head = $this->head->next;
        }

        // 插入到中间节点
        $i = 1;
        $head = $this->head;
        while (! is_null($head->next)) {

            if ($i === $index) {

                $head->next = $head->next->next;
                break;
            }

            ++ $i;
            $head = $head->next;
        }
    }
}

return [
    ["MyLinkedList","addAtHead","addAtTail","addAtIndex","get","deleteAtIndex","get"],
    [[],[1],[3],[1, 2],[1],[1],[1]]
];


