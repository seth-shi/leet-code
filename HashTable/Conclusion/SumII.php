<?php

namespace HashTable\Conclusion\SumII;

//    给定四个包含整数的数组列表 A , B , C , D ,计算有多少个元组 (i, j, k, l) ，使得 A[i] + B[j] + C[k] + D[l] = 0。
//
//    为了使问题简单化，所有的 A, B, C, D 具有相同的长度 N，且 0 ≤ N ≤ 500 。所有整数的范围在 -228 到 228 - 1 之间，最终结果不会超过 231 - 1 。
//
//    例如:
//
//    输入:
//    A = [ 1, 2]
//    B = [-2,-1]
//    C = [-1, 2]
//    D = [ 0, 2]
//
//    输出:
//    2
//
//    解释:
//    两个元组如下:
//    1. (0, 0, 0, 1) -> A[0] + B[0] + C[0] + D[1] = 1 + (-2) + (-1) + 2 = 0
//    2. (1, 1, 0, 0) -> A[1] + B[1] + C[0] + D[0] = 2 + (-1) + (-1) + 0 = 0
class Solution
{
    
    /**
     * @param Integer[] $A
     * @param Integer[] $B
     * @param Integer[] $C
     * @param Integer[] $D
     * @return Integer
     */
    public function fourSumCount($A, $B, $C, $D)
    {
        $map = [];
        $length = count($A);
        
        for ($i = 0; $i < $length; ++ $i) {
            
            for ($j = 0; $j < $length; ++ $j) {
             
                $sum = $A[$i] + $B[$j];
                $map[$sum] = ($map[$sum] ?? 0) + 1;
            }
        }
    
        $count = 0;
        for ($i = 0; $i < $length; ++ $i) {
        
            for ($j = 0; $j < $length; ++ $j) {
            
                $sum = ($C[$i] + $D[$j]) * - 1;
                
                $count += ($map[$sum] ?? 0);
            }
        }
        
        return $count;
    }
}


var_dump((new Solution())->fourSumCount([-1,1,1,1,-1],
                                                    [0,-1,-1,0,1],
                                                    [-1,-1,1,-1,-1],
                                                    [0,1,0,-1,-1]));
