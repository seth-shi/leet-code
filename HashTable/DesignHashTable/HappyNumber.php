<?php

namespace QueueAndStack\QueueFirstInFirstOut\HappyNumber;


//    编写一个算法来判断一个数是不是“快乐数”。
//
//    一个“快乐数”定义为：对于一个正整数，每一次将该数替换为它每个位置上的数字的平方和，然后重复这个过程直到这个数变为 1，也可能是无限循环但始终变不到 1。如果可以变为 1，那么这个数就是快乐数。

class Solution
{
    
    /**
     * O(1) 空间使用快慢指针拿环
     *
     * @param Integer $n
     * @return Boolean
     */
    public function isHappy($n)
    {
        $visited = [];
        
        do {
            
            $sum = 0;
            while ($n > 0) {
                
                $rem = $n % 10;
                $n = intval($n / 10);
                
                $sum += $rem * $rem;
            }
            
            if (array_key_exists($sum, $visited)) {
                
                return false;
            }
            
            $visited[$sum] = null;
            $n = $sum;
        } while ($n !== 1);
    
        return true;
    }
}
