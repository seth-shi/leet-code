<?php

namespace LinkedList\Conclusion\MergeTwoSortedLists;

//    将两个有序链表合并为一个新的有序链表并返回。新链表是通过拼接给定的两个链表的所有节点组成的。
//
//    示例：
//
//    输入：1->2->4, 1->3->4
//    输出：1->1->2->3->4->4

class ListNode
{
    public $val;
    public $next;

    public function __construct($val, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}

class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function mergeTwoLists($l1, $l2) {

        if (is_null($l1)) {

            return $l2;
        } else if (is_null($l2)) {

            return $l1;

        }

        // 找第一个节点值小的作为操作节点
        if ($l1->val > $l2->val) {
            list($l1, $l2) = [$l2, $l1];
        }

        $newHead = $l1;

        while (! is_null($l2)) {

            // 如果 l1 下一个没有节点了,提前退出
            // 防止后续操作补刀尾节点
            if (is_null($l1->next)) {

                break;
            }

            // 判断 l2 的值是否大于插入链表的当前和下一个值
            $nextVal = $l1->next->val ?? $l2->val - 1;
            if ($l2->val > $l1->val && $l2->val > $nextVal) {

                $l1 = $l1->next;
                continue;
            }

            $l2Node = $l2;
            $l2 = $l2->next;

            // 插入到 l1 之中
            $l2Node->next = $l1->next;
            $l1->next = $l2Node;
        }

        // 如果 l2 还没有遍历完,代表l1 已经走到尾节点
        // 这时候只要总是往 l1 的尾节点插入即可
        if (! is_null($l2)) {

            while ($l2) {

                $node = $l2;

                $l2 = $l2->next;

                $node->next = $l1->next;
                $l1->next = $node;
                $l1 = $l1->next;
            }
        }


        return $newHead;
    }
}


//[1,2,4]
//[1,3,4]
$l1 = new ListNode(1, new ListNode(2, new ListNode(4)));
$l2 = new ListNode(1, new ListNode(3, new ListNode(4)));

return [
    ["Solution","mergeTwoLists"],
    [[], [$l1, $l2]],
    [null, null]
];
