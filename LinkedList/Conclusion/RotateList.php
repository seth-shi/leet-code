<?php

namespace LinkedList\Conclusion\RotateList;

//
//    给定一个链表，旋转链表，将链表每个节点向右移动 k 个位置，其中 k 是非负数。
//
//    示例 1:
//
//    输入: 1->2->3->4->5->NULL, k = 2
//    输出: 4->5->1->2->3->NULL
//    解释:
//    向右旋转 1 步: 5->1->2->3->4->NULL
//    向右旋转 2 步: 4->5->1->2->3->NULL
//    示例 2:
//
//    输入: 0->1->2->NULL, k = 4
//    输出: 2->0->1->NULL
//    解释:
//    向右旋转 1 步: 2->0->1->NULL
//    向右旋转 2 步: 1->2->0->NULL
//    向右旋转 3 步: 0->1->2->NULL
//    向右旋转 4 步: 2->0->1->NULL

class ListNode
{
    public $val;
    public $next;

    /**
     * ListNode constructor.
     *
     * @param $val
     * @param $next
     */
    public function __construct($val, $next = null)
    {
        $this->val = $val;
        $this->next = $next;}
}

class Solution
{

    /**
     * @param ListNode $head
     * @param Integer  $k
     * @return ListNode
     */
    function rotateRight($head, $k)
    {
        if (is_null($head) || 0 === $k) {
            return $head;
        }

        // 快指针先行 k 步
        $linkLength = 0;
        $originMoveK = $k;
        $flag = false;
        $fast = $slow = $head;
        while (0 !== $k) {

            ++ $linkLength;
            -- $k;
            $fast = $fast->next;

            if (is_null($fast)) {
                $flag = true;
                $fast = $head;
                break;
            }
        }

        // 如果给出的长度超出了链表的长度
        if ($flag) {

            // 先取余数,防止遍历超出时间限制
            $mod = $originMoveK%$linkLength;
            if (0 === $mod) {
                return $head;
            }

            while (0 !== $mod) {

                -- $mod;
                $fast = $fast->next;
            }

        }

        // 最后快慢指针一起走,慢指针会停在截断点的末尾
        // 快指针停在未节点
        while (! is_null($fast->next)) {


            $slow = $slow->next;
            $fast = $fast->next;
        }

        // 先拿到慢指针下一个,即是选择点的开始
        $next = $slow->next;

        $slow->next = null;
        // 快指针走到节点的末尾
        $fast->next = $head;

        return $next;
    }
}
