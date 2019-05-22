<?php

namespace QueueAndStack\HashMap\FirstUniqueCharacterInAString;

//    给定一个字符串，找到它的第一个不重复的字符，并返回它的索引。如果不存在，则返回 -1。
//
//    案例:
//
//    s = "leetcode"
//    返回 0.
//
//    s = "loveleetcode",
//    返回 2.
//
//
//    注意事项：您可以假定该字符串只包含小写字母。
class Solution
{
    
    /**
     * @param String $s
     * @return Integer
     */
    public function firstUniqChar($s)
    {
        $minIndex = 26;
        $tickMap = array_fill(0, $minIndex, 0);
        $indexMap = array_fill(0, $minIndex, -1);
        
        $aCode = ord('a');
        for ($i = 0, $l = strlen($s); $i < $l; ++ $i) {
            
            $index = ord($s{$i}) - $aCode;
            $tickMap[$index] += 1;
            if ($indexMap[$index] === -1) {
                $indexMap[$index] = $i;
            }
        }
        
        
        // 拿到最小的值
        $min = INF;
        for ($i = 0; $i < $minIndex; ++ $i) {
           
            if ($tickMap[$i] === 1 && $indexMap[$i] < $min) {
                
                $min = $indexMap[$i];
            }
        }
        
        return $min === INF ? -1 : $min;
    }
}
