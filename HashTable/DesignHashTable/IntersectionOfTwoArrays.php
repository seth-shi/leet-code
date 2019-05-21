<?php

namespace QueueAndStack\QueueFirstInFirstOut\IntersectionOfTwoArrays;

//    给定两个数组，编写一个函数来计算它们的交集。
//
//    示例 1:
//
//    输入: nums1 = [1,2,2,1], nums2 = [2,2]
//    输出: [2]
//    示例 2:
//
//    输入: nums1 = [4,9,5], nums2 = [9,4,9,8,4]
//    输出: [9,4]
//    说明:
//
//    输出结果中的每个元素一定是唯一的。
//    我们可以不考虑输出结果的顺序。

class Solution
{
    
    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    public function intersection($nums1, $nums2)
    {
        $maps = [];
        
        for ($i = 0, $l = count($nums1); $i < $l; ++ $i) {
            
            $maps[$nums1[$i]] = null;
        }
      
        $inter = [];
        for ($k = 0, $l = count($nums2); $k < $l; ++ $k) {
            
            if (array_key_exists($nums2[$k], $maps)) {
            
                $inter[$nums2[$k]] = null;
            }
        }
       
        return array_keys($inter);
    }
}
