<?php

namespace LinkedList\Conclusion\CopyListWithRandomPointer;

//
//    给定一个链表，每个节点包含一个额外增加的随机指针，该指针可以指向链表中的任何节点或空节点。
//
//    要求返回这个链表的深拷贝。
//
//
//
//    输入：
//    {"$id":"1","next":{"$id":"2","next":null,"random":{"$ref":"2"},"val":2},"random":{"$ref":"2"},"val":1}
//
//    解释：
//    节点 1 的值是 1，它的下一个指针和随机指针都指向节点 2 。
//    节点 2 的值是 2，它的下一个指针指向 null，随机指针指向它自己。


class Node
{
    public $val;
    public $next;
    public $random;

    /**
     * Node constructor.
     *
     * @param Integer $val
     * @param Node    $next
     * @param Node    $random
     */
    public function __construct($val, $next, $random)
    {
        $this->val = $val;
        $this->next = $next;
        $this->random = $random;
    }
}

class Solution
{

    /**
     * @param Node $head
     * @return Node
     */
    function copyRandomList($head)
    {

        $map = [];
        $tmpH1 = $tmpH2 = $head;

        // 先遍历一次所有节点,用节点的 val 作映射
        // 如果题目中 val 会出现重复,可使用 hash_object
        while (! is_null($tmpH1)) {

            $map[$tmpH1->val] = $tmpH1;

            $tmpH1 = $tmpH1->next;
        }

        // 直接替换成为实际的值,需注意的就是 next
        // 需要先走下一步再替换,防止替换后值错乱
        $currNode = null;
        while (! is_null($tmpH2)) {

            $currNode = $tmpH2;

            if (! is_null($tmpH2->random)) {

                $tmpH2->random = $map[$tmpH2->random->val];
            }

            $tmpH2 = $tmpH2->next;

            if (! is_null($currNode->next)) {

                $currNode->next = $map[$currNode->next->val];
            }
        }

        return $head;
    }
}
