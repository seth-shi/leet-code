<?php

namespace QueueAndStack\StackLastInFirstOut\DailyTemperatures;

//    给出每日温度列表T，返回一个列表，以便在输入中的每一天告诉您需要等待多少天才能达到更温暖的温度。如果没有可能的未来日，请0改为。
//
//    例如，给定温度列表T = [73, 74, 75, 71, 69, 72, 76, 73]，您的输出应该是[1, 1, 4, 2, 1, 1, 0, 0]。
//
//    注意： 长度temperatures将在范围内[1, 30000]。每个温度都是该范围内的整数[30, 100]。

class Solution
{

    /**
     * @param Integer[] $T
     * @return Integer[]
     */
    function dailyTemperatures($T)
    {
        // 反向遍历这个数组
        $result = array_fill(0, $length = count($T), 0);
        $visited = [];

        for ($i = 0; $i < $length; ++ $i) {

            while (! empty($visited) && $T[$i] > $T[end($visited)]) {

                $index = array_pop($visited);
                $result[$index] = $i - $index;
            }

            $visited[] = $i;
        }

        return $result;
    }
}
