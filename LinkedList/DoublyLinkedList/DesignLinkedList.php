<?php

namespace LinkedList\DoublyLinkedList\DesignLinkedList;



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
    /**
     * @var $next Node
     * @var $prev Node
     */
    public $next;
    public $prev;
    public $val;

    public function __construct($val)
    {
        $this->val = $val;
    }
}

class MyLinkedList
{
    /**
     * @var Node
     */
    public $head;

    public function __construct()
    {
        $this->head = new Node(0);
    }


    public function get($index)
    {
        // 先行一步, 到达数据区
        $currNode = $this->head->next;

        for ($i = 0; ! is_null($currNode); ++ $i) {

            if ($index === $i) {

                return $currNode->val;
            }

            $currNode = $currNode->next;
        }

        return -1;
    }

    public function addAtHead($val)
    {
        $newNode = new Node($val);

        // 如果链表不为空,那么可以连接右节点
        if (! is_null($this->head->next)) {

            $this->head->next->prev = $newNode;
        }

        $newNode->next = $this->head->next;
        $newNode->prev = $this->head;

        $this->head->next = $newNode;
    }

    function addAtTail($val)
    {
        $newNode = new Node($val);
        $head = $this->head;

        while (! is_null($head->next)) {

            $head = $head->next;
        }

        $head->next = $newNode;
        $newNode->prev = $head;
    }

    function addAtIndex($index, $val)
    {
        $newNode = new Node($val);


        if (0 === $index) {

            $this->addAtHead($val);
            return;
        }

        // 先行一步到达数据区
        $currNode = $this->head->next;

        for ($i = 1; ! is_null($currNode); ++ $i) {

            if ($index === $i) {

                if (! is_null($currNode->next)) {

                    $currNode->next->prev = $newNode;
                }

                $newNode->next = $currNode->next;
                $newNode->prev = $currNode;

                $currNode->next = $newNode;
                break;
            }

            $currNode = $currNode->next;
        }

    }

    public function deleteAtIndex($index)
    {
        $currNode = $this->head->next;

        for ($i = 0; ! is_null($currNode); ++ $i) {

            if ($index === $i) {

                if (! is_null($currNode->next)) {

                    $currNode->next->prev = $currNode->prev;
                }

                $currNode->prev->next = $currNode->next;
                $currNode = null;
                break;
            }

            $currNode = $currNode->next;
        }

    }
}
