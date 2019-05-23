<?php

namespace HashTable\Conclusion\LongestSubstringWithoutRepeatingCharacters;


//    给定一个字符串，请你找出其中不含有重复字符的 最长子串 的长度。
//
//    示例 1:
//
//    输入: "abcabcbb"
//    输出: 3
//    解释: 因为无重复字符的最长子串是 "abc"，所以其长度为 3。
//    示例 2:
//
//    输入: "bbbbb"
//    输出: 1
//    解释: 因为无重复字符的最长子串是 "b"，所以其长度为 1。
//    示例 3:
//
//    输入: "pwwkew"
//    输出: 3
//    解释: 因为无重复字符的最长子串是 "wke"，所以其长度为 3。
//         请注意，你的答案必须是 子串 的长度，"pwke" 是一个子序列，不是子串。

class Solution
{

    /**
     * 使用双指针标记位置
     *
     * @param String $s
     * @return Integer
     */
    public function lengthOfLongestSubstring($s)
    {
        $i = $j = 0;
        $tick = $max = 0;
        $length = strlen($s);
    
        $visited = [];
        while ($j < $length) {
        
            $char = $s{$j};
    
            
            if (array_key_exists($char, $visited)) {
            
                if ($tick > $max) {
                    $max = $tick;
                }
            
                $tick = 0;
                $visited = [];
                ++$i;
                $j = $i;
                continue;
            } else {
            
                ++$j;
            }
        
            $visited[$char] = true;
            ++$tick;
        }
    
        return $tick > $max ? $tick : $max;
    }
}
