<?php

namespace LinkedList\Conclusion\AddTwoNumbers;


//    给出两个 非空 的链表用来表示两个非负的整数。其中，它们各自的位数是按照 逆序 的方式存储的，并且它们的每个节点只能存储 一位 数字。
//
//    如果，我们将这两个数相加起来，则会返回一个新的链表来表示它们的和。
//
//    您可以假设除了数字 0 之外，这两个数都不会以 0 开头。
//
//    示例：
//
//    输入：(2 -> 4 -> 3) + (5 -> 6 -> 4)
//    输出：7 -> 0 -> 8
//    原因：342 + 465 = 807


class ListNode
{
    public $val;
    public $next = null;


    public function __construct($val)
    {
        $this->val = $val;
    }

}


class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {

        $into = 0;

        $head = null;
        $l = null;

        while (! is_null($l1) && ! is_null($l2)) {

            $val = $l1->val + $l2->val + $into;
            $into = 0;
            if ($val >= 10) {

                $val -= 10;
                $into = 1;
            }

            // 插入到链表
            $newNode = new ListNode($val);
            if (is_null($l)) {
                $head = $l = $newNode;
            } else {
                $l->next = $newNode;
                $l = $newNode;
            }

            $l1 = $l1->next;
            $l2 = $l2->next;
        }

        // 防止剩余链表没有遍历完成
        $l1 = $l1 ?? $l2;
        while (! is_null($l1)) {

            $val = $l1->val + $into;
            $into = 0;
            if ($val >= 10) {

                $val -= 10;
                $into = 1;
            }

            // 插入到链表
            $newNode = new ListNode($val);
            if (is_null($l)) {
                $head = $l = $newNode;
            } else {
                $l->next = $newNode;
                $l = $newNode;
            }

            $l1 = $l1->next;
        }

        // 防止两个个位数相加大于 10
        if ($into > 0) {

            // 插入到链表
            $newNode = new ListNode($into);
            $l->next = $newNode;
        }

        return $head;
    }
}
