<?php

namespace QueueAndStack\QueueFirstInFirstOut\CloneGraph;

//  给定连接的  无向图中的节点的引用  ，返回图的深拷贝（克隆）。图中的每个节点都包含val（int）和List[Node]其邻居的list（）。



class Node {
    public $val;
    public $neighbors;

    /**
     * Node constructor.
     *
     * @param $val
     * @param $neighbors Node[]
     */
    function __construct($val, $neighbors) {
        $this->val = $val;
        $this->neighbors = $neighbors;
    }
}


class Solution {

    protected $map = [];

    /**
     * @param Node $node
     * @return Node
     */
    function cloneGraph($node) {

        return $this->DFS($node);
    }

    protected function DFS($node)
    {
        /**
         * @var $node Node
         */
        if (is_null($node)) {
            return null;
        }

        // 如果已经遍历过了
        if (array_key_exists($node->val, $this->map)) {

            return $this->map[$node->val];
        }

        $cloneNode = new Node($node->val, []);
        $this->map[$node->val] = $cloneNode;

        foreach ($node->neighbors as $n) {

            $cloneNode->neighbors[] = $this->DFS($n);
        }

        return $cloneNode;
    }
}
