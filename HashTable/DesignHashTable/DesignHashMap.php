<?php

namespace QueueAndStack\QueueFirstInFirstOut\DesignHashSet;

//    不使用任何内建的哈希表库设计一个哈希映射
//
//    具体地说，你的设计应该包含以下的功能
//
//    put(key, value)：向哈希映射中插入(键,值)的数值对。如果键对应的值已经存在，更新这个值。
//    get(key)：返回给定的键所对应的值，如果映射中不包含这个键，返回-1。
//    remove(key)：如果映射中存在这个键，删除这个数值对。

class Node
{
    public $key;
    public $val;
    public $next;
    
    /**
     * Node constructor.
     *
     * @param $key
     * @param $val
     * @param $next
     */
    public function __construct($key, $val, $next = null)
    {
        $this->key = $key;
        $this->val = $val;
        $this->next = $next;
    }
    
}

class MyHashMap
{
    protected $size = 9;
    protected $data;
    
    public function __construct()
    {
        $this->data = array_fill(0, $this->size-1, null);
    }
    
    public function put($key, $value)
    {
        $hashKey = $this->hashKey($key);
        $head = $this->data[$hashKey];
        
        if (is_null($head)) {
            
            $this->data[$hashKey] = new Node($key, $value);
            return;
        }
        
        $end = $head;
        while (! is_null($head)) {
            
            if ($head->key === $key) {
                
                $head->val = $value;
                return;
            }
            
            $end = $head;
            $head = $head->next;
        }
        
        $end->next = new Node($key, $value);
    }
    
    public function get($key)
    {
        $hashKey = $this->hashKey($key);
        $head = $this->data[$hashKey];
        
        if (is_null($head)) {
        
            return -1;
        }
    
        while (! is_null($head)) {
        
            if ($head->key === $key) {
            
                return $head->val;
            }
        
            $head = $head->next;
        }
        
        return -1;
    }
    
    public function remove($key)
    {
        $hashKey = $this->hashKey($key);
        $head = $this->data[$hashKey];
    
        if (is_null($head)) {
        
            return;
        }
        
        if ($head->key === $key) {
            $this->data[$hashKey] = $head->next;
            return;
        }
    
        while (! is_null($head->next)) {
        
            if ($head->next->key === $key) {
                
                $head->next = $head->next->next;
                return;
            }
        
            $head = $head->next;
        }
    }
    
    protected function hashKey($key)
    {
        return $key%$this->size;
    }
}
