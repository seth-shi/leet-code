<?php

namespace QueueAndStack\HashMap\IntersectionOfTwoArraysII;

//    给定两个数组，编写一个函数来计算它们的交集。
//
//    示例 1:
//
//    输入: nums1 = [1,2,2,1], nums2 = [2,2]
//    输出: [2,2]
//    示例 2:
//
//    输入: nums1 = [4,9,5], nums2 = [9,4,9,8,4]
//    输出: [4,9]
//    说明：
//
//    输出结果中每个元素出现的次数，应与元素在两个数组中出现的次数一致。
//    我们可以不考虑输出结果的顺序。
//    进阶:
//
//    如果给定的数组已经排好序呢？你将如何优化你的算法？
//         使用两个指针迭代
//    如果 nums1 的大小比 nums2 小很多，哪种方法更优？
//          用 nums1 做哈希, nums2 比较
//    如果 nums2 的元素存储在磁盘上，磁盘内存是有限的，并且你不能一次加载所有的元素到内存中，你该怎么办？
//          还是 nums1 哈希, nums2 分片读取
class Solution
{
    
    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    public function intersect($nums1, $nums2)
    {
        $tickMap = [];
        for ($i = 0, $l = count($nums1); $i < $l; ++ $i) {
            
            $tickMap[$nums1[$i]] = ($tickMap[$nums1[$i]] ?? 0) + 1;
        }
    
        $result = [];
        for ($i = 0, $l = count($nums2); $i < $l; ++ $i) {
            
            $val = $nums2[$i];
            if (array_key_exists($val, $tickMap) && $tickMap[$val] > 0) {
                
                $tickMap[$val] -= 1;
                $result[] = $val;
            }
        }
        
        return $result;
    }
    
    /**
     * 排好序的使用双指针
     *
     * @param $nums1
     * @param $nums2
     * @return array
     */
    public function intersectBySort($nums1, $nums2)
    {
        $i = $j = 0;
        
        $nums1Length = count($nums1);
        $nums2Length = count($nums2);
        $result = [];
        
        while ($i < $nums1Length && $j < $nums2Length) {
            
            if ($nums1[$i] < $nums2[$j]) {
                
                ++ $i;
            } elseif ($nums1[$i] > $nums2[$j]) {
                
                ++ $j;
            } else {
    
                array_push($result, $nums1[$i]);
                ++ $i;
                ++ $j;
            }
        }
        
        return $result;
    }
}
