<?php

namespace QueueAndStack\StackLastInFirstOut\ValidParentheses;


//    给定一个只包括 '('，')'，'{'，'}'，'['，']' 的字符串，判断字符串是否有效。
//
//    有效字符串需满足：
//
//    左括号必须用相同类型的右括号闭合。
//    左括号必须以正确的顺序闭合。
//    注意空字符串可被认为是有效字符串。
//
//    示例 1:
//
//    输入: "()"
//    输出: true
//    示例 2:
//
//    输入: "()[]{}"
//    输出: true
//    示例 3:
//
//    输入: "(]"
//    输出: false
//    示例 4:
//
//    输入: "([)]"
//    输出: false
//    示例 5:
//
//    输入: "{[]}"
//    输出: true

class Solution
{
    /**
     * @param String $s
     * @return Boolean
     */
    function isValid($s)
    {
        $length = strlen($s);

        $stack = [];
        $brackets = [
            '[' => ']',
            '{' => '}',
            '(' => ')',
        ];

        for ($i = 0; $i < $length; ++ $i) {

            $char = $s{$i};

            // 如果是左边的括号, 那么放入栈,
            if (array_key_exists($char, $brackets)) {

                $stack[] = $char;
                continue;
            }

            // 如果是右边的括号,从栈中取出对比
            $endChar = array_pop($stack);

            // 如果取不出数据, {}} 这样子会取不出数据
            if (is_null($endChar)) {
                return false;
            }

            // 看是否匹配大括号
            if ($brackets[$endChar] !== $char) {
                return false;
            }
        }

        return empty($stack);
    }
}
