<?php

namespace HashTable\DesignTheKey\GroupAnagrams;

//    给定一个字符串数组，将字母异位词组合在一起。字母异位词指字母相同，但排列不同的字符串。
//
//    示例:
//
//    输入: ["eat", "tea", "tan", "ate", "nat", "bat"],
//    输出:
//    [
//        ["ate","eat","tea"],
//        ["nat","tan"],
//        ["bat"]
//    ]
//    说明：
//
//    所有输入均为小写字母。
//    不考虑答案输出的顺序。
class Solution
{
    
    /**
     * @param String[] $strs
     * @return String[][]
     */
    public function groupAnagrams($strs)
    {
        $map = [];
        
        for ($i = 0, $l = count($strs); $i < $l; ++ $i) {
        
            $strArray = str_split($strs[$i]);
            sort($strArray);
            $key = implode($strArray, '');
            
            if (array_key_exists($key, $map)) {
                
                array_push($map[$key], $strs[$i]);
            } else {
                
                $map[$key] = [$strs[$i]];
            }
        }
        
        return array_values($map);
    }
}
