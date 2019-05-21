<?php

namespace QueueAndStack\StackAndDFS\BinaryTreeInorderTraversal;
//
//    给定一个二叉树，返回它的中序 遍历。
//
//    示例:
//
//    输入: [1,null,2,3]
//       1
//        \
//        2
//        /
//        3
//
//    输出: [1,3,2]
//    进阶: 递归算法很简单，你可以通过迭代算法完成吗？


class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    function __construct($value)
    {
        $this->val = $value;
    }
}

class Solution
{
    protected $result = [];

    /**
     * @param TreeNode $root
     * @return Integer[]
     */
    public function inorderTraversal($root)
    {
        // 递归实现
         $this->DFS($root);
        // 迭代实现
        // $this->BFS($root);

        return $this->result;
    }

    public function BFS($node)
    {
        $openLists = [];
        $currNode = $node;

        while (! is_null($currNode) || ! empty($openLists)) {

            while (! is_null($currNode)) {

                array_push($openLists, $currNode);
                $currNode = $currNode->left;
            }

            $currNode = array_pop($openLists);
            $this->result[] = $currNode->val;

            $currNode = $currNode->right;
        }
    }

    public function DFS($node)
    {
        if (! is_null($node->left)) {

            $this->DFS($node->left);
        }

        $this->result[] = $node->val;

        if (! is_null($node->right)) {

            $this->DFS($node->right);
        }
    }
}
