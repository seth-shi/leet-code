//    相交链表
//
//    注意：
//
//    如果两个链表没有交点，返回 null.
//    在返回结果后，两个链表仍须保持原有的结构。
//    可假定整个链表结构中没有循环。
//    程序尽量满足 O(n) 时间复杂度，且仅用 O(1) 内存。

/**
 * Definition for singly-linked list.
 * struct ListNode {
 *     int val;
 *     struct ListNode *next;
 * };
 */

//               a
//           +--------+
//                    |   c
//                    +---------->
//                    |
//    +---------------+
//           b
//    假设两条链表分分别长为 a+c  b+c
//    使两条链表这样子行走,总是会相遇
//    a + c + b == b + c + a
struct ListNode *getIntersectionNode(struct ListNode *headA, struct ListNode *headB) {

    if (NULL == headA || NULL == headB) {

        return NULL;
    }

	struct ListNode *headAP = headA;
	struct ListNode *headBP = headB;

	while (true) {


        if (NULL == headAP && NULL == headBP) {

            return NULL;
        }

		// 当 A 链表走到了尽头
		if (NULL == headAP) {
			// 使链表 A 等于链表 B 的头, 再走一遍
			headAP = headB;
		}

		if (NULL == headBP) {

			headBP = headA;
		}

		// 如果两条链表都为 NULL, 而且这一点不是相交点
		// 那么代表这两个链表没有交点
		if (headAP == headBP) {

			return headAP;
			break;
		}

		headAP = headAP->next;
		headBP = headBP->next;
	}

}
