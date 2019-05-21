<?php

namespace QueueAndStack\QueueFirstInFirstOut\OpenTheLock;

//    你有一个带有四个圆形拨轮的转盘锁。每个拨轮都有10个数字： '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' 。每个拨轮可以自由旋转：例如把 '9' 变为  '0','0' 变为 '9' 。每次旋转都只能旋转一个拨轮的一位数字。
//
//    锁的初始数字为 '0000' ,一个代表四个拨轮的数字的字符串。
//
//    列表 deadends 包含了一组死亡数字,一旦拨轮的数字和列表里的任何一个元素相同,这个锁将会被永久锁定,无法再被旋转。
//
//    字符串 target 代表可以解锁的数字,你需要给出最小的旋转次数,如果无论如何不能解锁,返回 -1。
//
//
//
//    示例 1:
//
//    输入：deadends = ["0201","0101","0102","1212","2002"], target = "0202"
//    输出：6
//    解释：
//    可能的移动序列为 "0000" -> "1000" -> "1100" -> "1200" -> "1201" -> "1202" -> "0202"。
//    注意 "0000" -> "0001" -> "0002" -> "0102" -> "0202" 这样的序列是不能解锁的,
//    因为当拨动到 "0102" 时这个锁就会被锁定。

class Solution
{
    /**
     * @param String[] $deadends
     * @param String   $target
     * @return Integer
     */
    public function openLock($deadends, $target)
    {

        $q = ['0000'];

        // 必须换成把浏览过的换成 key 映射
        // 防止浏览过的数字太多,使用 in_array
        // 太慢会超时, 时间从 1.8s => 0.016
        $visited = ['0000' => true];
        $deadends = array_flip($deadends);

        $level = 0;

        // 只要队列里的数据不为空
        while (! empty($q)) {

            // 拿到当前队列里的个数出队
            // 不会读取到后续入队的数据
            $size = count($q);
            while ($size > 0) {

                // 每次出第一个元素
                $first = array_shift($q);

                // 如果在排除数据之中, 跳过
                if (array_key_exists($first, $deadends)) {
                    --$size;
                    continue;
                }

                // 数字相等,那么就找到了这个数字
                if ($first == $target) {
                    return $level;
                }

                // 遍历当前这个数字,可能任意一个数字发生变化
                for ($i = 0; $i < 4; ++$i) {

                    $inTmp = $first;
                    $deTmp = $first;

                    // 其中一位数字往 + 或者 - 发展
                    $inTmp{$i} = ($inTmp{$i}+1)%10;
                    if ($deTmp{$i} == 0) {
                        $deTmp{$i} = 9;
                    } else {
                        $deTmp{$i} = $deTmp{$i}-1;
                    }

                    // 如果这个数字已经遍历过了,或者在排除数据中,那么不予理会.
                    if (! array_key_exists($inTmp, $visited) && ! array_key_exists($inTmp, $deadends)) {

                        $q[] = $inTmp;
                        $visited[$inTmp] = true;
                    }

                    if (! array_key_exists($deTmp, $visited) && ! array_key_exists($deTmp, $deadends)) {

                        $q[] = $deTmp;
                        $visited[$deTmp] = true;
                    }
                }

                --$size;
            }

            ++$level;
        }

        return -1;
    }
}
