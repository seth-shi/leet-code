//    给定一个单链表，把所有的奇数节点和偶数节点分别排在一起。请注意，这里的奇数节点和偶数节点指的是节点编号的奇偶性，而不是节点的值的奇偶性。
//
//    请尝试使用原地算法完成。你的算法的空间复杂度应为 O(1)，时间复杂度应为 O(nodes)，nodes 为节点总数。

/**
 * Definition for singly-linked list.
 * struct ListNode {
 *     int val;
 *     struct ListNode *next;
 * };
 */
struct ListNode* oddEvenList(struct ListNode* head) {

	if (NULL == head || NULL == head->next || NULL == head->next->next) {

		return head;
	}

	// 使用四个指针
	struct ListNode *singleTail = head;
	struct ListNode *doubleHead = head->next;
	struct ListNode *doubleTail = doubleHead;
	struct ListNode *p = head->next->next;

	int count = 0;
	while (NULL != p) {


		++count;


		// 如果是偶数, 不需要执行节点拆除,
		// 直接把偶数结尾节点指向新节点即可
		if (0 == count % 2) {

			doubleTail->next = p;
			doubleTail = p;
			p = p->next;
			continue;
		}

		// 如果是奇数节点,
		// 偶数节点的末尾的 next 指向待计算节点
		doubleTail->next = p->next;
		singleTail->next = p;
		singleTail = p;

		// 先移动节点,防止待会奇数节点连接影响
		p = p->next;

		// 并把新奇数节点的 next 指向偶数节点的头
		singleTail->next = doubleHead;
	}


	return head;
}
