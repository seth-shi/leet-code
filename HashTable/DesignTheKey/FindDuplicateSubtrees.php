<?php

namespace HashTable\DesignTheKey\FindDuplicateSubtrees;


//    给定一棵二叉树，返回所有重复的子树。对于同一类的重复子树，你只需要返回其中任意一棵的根结点即可。
//
//    两棵树重复是指它们具有相同的结构以及相同的结点值。
//
//    示例 1：
//
//            1
//            / \
//            2   3
//    /   / \
//    4   2   4
//    /
//    4
//    下面是两个重复的子树：
//
//          2
//          /
//          4
//    和
//
//        4
//    因此，你需要以列表的形式返回上述重复子树的根结点。

/**
 * Definition for a binary tree node.
 */
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
    protected $map = [];
    protected $rootNodes = [];
    
    /**
     * @param TreeNode $root
     * @return TreeNode[]
     */
    public function findDuplicateSubtrees($root)
    {
        $this->serialize($root);
        
        return $this->rootNodes;
    }
    
    protected function serialize($root)
    {
        if (is_null($root)) {
            
            return '#';
        }
        
        $code = "{$root->val}," . $this->serialize($root->left) . "," . $this->serialize($root->right);
        
        // 只记录第一次
        if (
            array_key_exists($code, $this->map) &&
            $this->map[$code] === 1
        ) {
            
            array_push($this->rootNodes, $root);
        }
        
        $this->map[$code] = ($this->map[$code] ?? 0) + 1;
        
        return $code;
    }
}
