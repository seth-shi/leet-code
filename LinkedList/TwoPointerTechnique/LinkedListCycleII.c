//    给定一个链表，返回链表开始入环的第一个节点。 如果链表无环，则返回 null。
//
//    为了表示给定链表中的环，我们使用整数 pos 来表示链表尾连接到链表中的位置（索引从 0 开始）。 如果 pos 是 -1，则在该链表中没有环。
//
//    说明：不允许修改给定的链表。
//
//    进阶：
//    你是否可以不用额外空间解决此题？ !!!
// (网上查阅: 不适用额外空间更多的是指 O(1) 空间,而不是不使用空间, 原地算法才是不使用额外空间.

struct ListNode *detectCycle(struct ListNode *head) {

    struct ListNode *slow = head;
    struct ListNode *fast = head;


    while (NULL != fast && NULL != fast->next) {

        slow = slow->next;
        fast = fast->next->next;

        // 假设在 x 处相遇,而且快指针走的路程是慢指针的二倍
        // slow = a + b
        // fast = a + b + c + b = 2 slow = 2(a + b) ==> c = a
        // 所以我们只需要让其中一个节点从头开始
        // 另一个节点从 x 处走,再次相遇即为链表环点
        //    a
        // +----+--+
        //  c   ^  |  b
        //      +--+  x
        // 两指针相遇
        if (slow == fast) {

            slow = head;

            while (slow != fast) {

                slow = slow->next;
                fast = fast->next;
            }

            return fast;
        }
    }


    return NULL;
}
