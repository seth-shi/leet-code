
//    给定一个链表，判断链表中是否有环。
//
//    为了表示给定链表中的环，我们使用整数 pos 来表示链表尾连接到链表中的位置（索引从 0 开始）。 如果 pos 是 -1，则在该链表中没有环。
//    进阶：
//
//    你能用 O(1)（即，常量）内存解决此问题吗？


bool hasCycle(struct ListNode *head) {

    // 定义一个快指针和一个慢指针
    struct ListNode *slow = head;
    struct ListNode *fast = head;

    // 总是快指针先走,所以只用判断快指针即可
    while (NULL != fast && NULL != fast->next) {

        // 慢指针走一步
        // 快指针走两步
        slow = slow->next;
        fast = fast->next->next;

        // 当快慢指针相遇,即可认为有环
        if (fast == slow) {

            return true;
        }
    }

    return false;
}
