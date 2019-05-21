<?php

namespace QueueAndStack\StackLastInFirstOut\EvaluateReversePolishNotation;

//    根据逆波兰表示法，求表达式的值。
//
//    有效的运算符包括 +, -, *, / 。每个运算对象可以是整数，也可以是另一个逆波兰表达式。
//
//    说明：
//
//    整数除法只保留整数部分。
//    给定逆波兰表达式总是有效的。换句话说，表达式总会得出有效数值且不存在除数为 0 的情况。


class Solution
{

    /**
     * @param String[] $tokens
     * @return Integer
     */
    function evalRPN($tokens)
    {
        $stack = [];

        foreach ($tokens as $var) {

            switch ($var) {

                case '+':
                    $stack[] = array_pop($stack) + array_pop($stack);
                    break;
                case '-':
                    $b = array_pop($stack);
                    $a = array_pop($stack);
                    $stack[] = $a - $b;
                    break;
                case '*':
                    $stack[] = array_pop($stack) * array_pop($stack);
                    break;
                case '/':
                    $b = array_pop($stack);
                    $a = array_pop($stack);
                    $stack[] = intval($a / $b);
                    break;
                default:
                    $stack[] = intval($var);
                    break;
            }

        }

        return array_pop($stack);
    }
}
