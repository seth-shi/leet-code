<?php

namespace QueueAndStack\QueueFirstInFirstOut\PerfectSquares;


class Solution
{

    /**
     * 如果是能够被4整除的，都等于不断除以4，
     * 直至不让被4整除后余下的那个数对应的完全平方个数，
     * 比如16等于1，12等于3，4等于1.；如果n取余8余7，
     * 那么它的最少的完全平方数一定是4；完全平方数是2的就得通过循环判断了，
     * 剩下的就完全平方数为3的了。
     *
     * @param Integer $n
     * @return Integer
     */
    function numSquares($n)
    {

        while ($n%4 === 0) {
            $n /= 4;
        }

        if ($n%8 == 7) {
            return 4;
        }

        for ($i = 0; $i*$i <= $n; ++$i) {

            if ($n === $i*$i) {
                return 1;
            }
        }

        for ($j = 0; $j*$j <= $n; ++$j) {

            $number = (int)sqrt($n-$j*$j);

            if ($j*$j+$number*$number == $n) {

                return 2;
            }

        }

        return 3;
    }
}


return [
    ['Solution', 'numSquares'],
    [[], [112]],
    [null, 4]
];
