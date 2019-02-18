//    反转一个单链表。
//
//    示例:
//
//    输入: 1->2->3->4->5->NULL
//    输出: 5->4->3->2->1->NULL

/**
 * Definition for singly-linked list.
 * struct ListNode {
 *     int val;
 *     struct ListNode *next;
 * };
 */
struct ListNode* reverseList(struct ListNode* head) {

    if (NULL == head) {

        return head;
    }

    struct ListNode *tmpHead = head, *nextNode;

    while (NULL != head->next) {

        // 把当前 '头结点' 的下一个移动到 `真正的头结点`
        nextNode = head->next;
        head->next = head->next->next;

        nextNode->next = tmpHead;
        tmpHead = nextNode;

    }


    return tmpHead;
}
