<?php

namespace HashTable\DesignTheKey\ValidSudoku;

//    判断一个 9x9 的数独是否有效。只需要根据以下规则，验证已经填入的数字是否有效即可。
//
//    数字 1-9 在每一行只能出现一次。
//    数字 1-9 在每一列只能出现一次。
//    数字 1-9 在每一个以粗实线分隔的 3x3 宫内只能出现一次。
//
//
//    上图是一个部分填充的有效的数独。
//
//    数独部分空格内已填入了数字，空白格用 '.' 表示。
class Solution
{
    
    /**
     * @param String[][] $board
     * @return Boolean
     */
    function isValidSudoku($board)
    {
        $hashMap = [];
        
        for ($y = 0, $yLength = count($board); $y < $yLength; ++ $y) {
            
            for ($x = 0, $xLength = count($board[$y]); $x < $xLength; ++ $x) {
                
                $char = $board[$y][$x];
                
                if ($char === '.') {
                    continue;
                }
                
                $t = ":{$char}:";
                
                if (
                    array_key_exists($y.$t, $hashMap) ||
                    array_key_exists($t.$x, $hashMap) ||
                    array_key_exists(intval($y/3).$t.intval($x/3), $hashMap)
                ) {
                    return false;
                }
                
                $hashMap[$y.$t] = true;
                $hashMap[$t.$x] = true;
                $hashMap[intval($y/3).$t.intval($x/3)] = true;
            }
        }
        
        return true;
    }
}
