//    反转一个单链表。(递归的方法)
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

		return NULL;
	}
	else if (NULL == head->next) {

		return head;
	}

	struct ListNode *currNode = reverseList(head->next);


	head->next->next = head;
	head->next = NULL;

	return currNode;
}


//    reverseList([1, 2, 3, 4, 5]) {
//
//        reverseList([2, 3, 4, 5]) {
//
//            reverseList([3, 4, 5]) {
//
//                reverseList([4, 5]) {
//
//                    reverseList([5]) {
//
//                        // 1. 这里 next 为 NULL, 所以返回当前自己
//                        return 5;
//                    }
//
//                    // 2. 这一步我们需要拿到 5 的指针指向 4
//                    // 并把 4 的 next 置空
//                    [4, 5]->next->next = [4, 5];
//                    [4, 5]->next = NULL;
//
//                    return [5, 4];
//                }
//
//                // 3. 这里的参数里实际上 5 已经被内层递归置为 NULL
//                // 这一步我们需要拿到 4 的指针,然后把它指向 3
//                // 并把 3 的 next 置空
//                [3, 4, '5']->next->next = [3, 5];
//                [3, 4]->next;
//
//                return [5, 4, 3];
//            }
//
//            // 4.
//            [2, 3, '4', '5']->next->next = [2, 3, '4', '5'];
//            [2, 3]->next = NULL;
//
//            return [5, 4, 3, 2];
//        }
//
//        // 5.
//        [1, 2, '3', '4', '5']->next->next = [1, 2, '3', '4', '5'];
//        [1, 2]->next = NULL;
//
//        return [5, 4, 3, 2, 1];
//    }
