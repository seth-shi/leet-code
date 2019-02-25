//    删除链表中等于给定值 val 的所有节点。
//
//    示例:
//
//    输入: 1->2->6->3->4->5->6, val = 6
//    输出: 1->2->3->4->5

/**
 * Definition for singly-linked list.
 * struct ListNode {
 *     int val;
 *     struct ListNode *next;
 * };
 */
struct ListNode* removeElements(struct ListNode* head, int val) {

	struct ListNode *fast = head, *slow = head;

	if (NULL == head) {

		return NULL;
	}

    // 判断头部是否需要删除的,因为快指针没有对头判断
	bool isRemoveHead = head->val == val;

	fast = fast->next;
	while (NULL != fast) {

		if (fast->val == val) {

			fast = fast->next;
			slow->next = fast;
			continue;
		}


		fast = fast->next;
		slow = slow->next;
	}

	if (isRemoveHead) {

		head = head->next;
	}

	return head;
}
