<?php

namespace LinkedList\Conclusion\FlattenAMultilevelDoublyLinkedList;

//    扁平化多级双向链表
//    您将获得一个双向链表，除了下一个和前一个指针之外，它还有一个子指针，可能指向单独的双向链表。这些子列表可能有一个或多个自己的子项，依此类推，生成多级数据结构，如下面的示例所示。
//
//    扁平化列表，使所有结点出现在单级双链表中。您将获得列表第一级的头部。
//    示例:
//
//    输入:
//     1---2---3---4---5---6--NULL
//    |
//    7---8---9---10--NULL
//    |
//    11--12--NULL
//
//    输出:
//    1-2-3-7-8-11-12-9-10-4-5-6-NULL

class Node
{
    public $val;
    public $prev;
    public $next;
    public $child;

    function __construct($val, $prev = null, $next = null, $child = null)
    {
        $this->val = $val;
        $this->prev = $prev;
        $this->next = $next;
        $this->child = $child;
    }
}


class Solution
{

    /**
     * @param Node $head
     * @return Node
     */
    function flatten($head)
    {

        $p = $head;

        if (is_null($head)) {
            return null;
        }

        if (is_null($head->child)) {

            $p->next = $this->flatten($head->next);
        } else {

            $returnNode = $returnHead = $this->flatten($head->child);
            $head->child = null;

            // 取到子链表的结尾
            while (! is_null($returnNode->next)) {

                $returnNode = $returnNode->next;
            }


            $tmpHead = $this->flatten($head->next);
            // 防止单'child'链表出现 null
            if (! is_null($tmpHead)) {

                $tmpHead->prev = $returnNode;
            }

            // 先把子链表拼接完毕
            // 然后再拼接主链表
            $returnNode->next = $tmpHead;
            $returnHead->prev = $p;
            $p->next = $returnHead;
        }

        return $p;
    }

}
