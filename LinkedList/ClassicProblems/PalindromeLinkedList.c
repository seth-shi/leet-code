//      回文链表
//    请判断一个链表是否为回文链表。
//
//    示例 1:
//
//    输入: 1->2
//    输出: false
//    示例 2:
//
//    输入: 1->2->2->1
//    输出: true
//    进阶：
//    你能否用 O(n) 时间复杂度和 O(1) 空间复杂度解决此题？


/**
 * Definition for singly-linked list.
 * struct ListNode {
 *     int val;
 *     struct ListNode *next;
 * };
 */
bool isPalindrome(struct ListNode* head) {

	if (NULL == head || NULL == head->next) {

		return true;
	}

	struct ListNode *fast = head, *slow = head;
	int halfLinkLength = 0;
	// 先找到链表的中间节点
	while (NULL != fast) {

		// 单数链表,在多走一步
		if (NULL == fast->next) {

			slow = slow->next;
            break;
		}

		++halfLinkLength;
		fast = fast->next->next;
		slow = slow->next;
	}

	// 反转链表
	struct ListNode *moveHead = slow, *halfHead = slow, *nextNode;

	while (NULL != halfHead->next) {

		// 把当前 '头结点' 的下一个移动到 `真正的头结点`
		nextNode = halfHead->next;
		halfHead->next = halfHead->next->next;

		nextNode->next = moveHead;
		moveHead = nextNode;
	}


	while (0 != halfLinkLength) {

		if (moveHead->val != head->val) {

			return false;
		}

		--halfLinkLength;
		head = head->next;
		moveHead = moveHead->next;
	}

	return true;
}
