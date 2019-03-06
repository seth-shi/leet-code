<?php

namespace QueueAndStack\QueueFirstInFirstOutDataStructure\OpenTheLock;

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






$locks = ["2663", "7363", "2311", "8379", "9055", "0185", "5250", "2534", "4197", "1940", "4551", "5166", "9904", "1259", "3930", "7429", "6117", "1842", "6544", "1976", "8241", "8433", "9614", "9561", "1928", "4730", "8660", "7036", "9008", "2132", "1479", "6943", "5551", "3975", "3396", "7423", "3404", "8428", "3100", "7309", "8641", "4014", "3851", "2194", "7987", "6565", "6721", "8584", "7144", "4587", "9259", "2664", "9882", "6002", "7244", "3472", "1667", "2084", "3993", "9940", "2734", "3075", "6145", "7772", "3284", "9481", "2194", "3990", "6307", "8925", "3358", "3980", "6850", "4361", "3102", "0541", "7084", "1767", "3693", "4513", "7833", "5181", "5954", "1283", "0414", "3661", "2615", "0114", "5616", "6679", "2475", "7564", "7184", "4389", "7860", "3964", "3752", "4476", "9622", "8862", "7185", "3709", "9115", "8230", "0255", "8755", "4522", "4186", "2664", "8789", "6132", "8375", "1850", "9777", "3624", "1025", "5941", "1604", "0954", "0641", "7910", "7807", "0483", "3616", "1411", "4587", "5386", "2258", "0807", "7362", "7559", "1397", "2166", "3574", "6056", "2702", "4258", "9914", "3546", "3367", "1551", "5791", "5763", "2354", "4568", "4316", "5755", "4516", "0278", "7413", "2906", "6914", "0392", "6854", "6336", "3559", "9596", "7579", "1445", "1646", "7395", "4359", "8801", "5487", "4553", "1144", "2754", "8675", "3082", "6056", "9580", "2903", "6941", "2944", "9160", "3749", "3064", "4588", "9808", "2539", "6390", "6953", "0051", "9972", "5911", "0671", "4810", "3896", "9486", "8412", "9286", "4067", "7349", "9938", "0658", "7719", "6027", "2519", "9184", "0033", "5781", "5867", "1083", "3262", "7983", "5441", "7150", "8944", "8543", "0252", "2296", "4780", "0060", "1408", "4610", "8213", "5111", "9817", "1465", "0787", "5145", "5780", "0398", "4089", "5997", "1837", "2693", "3769", "5491", "8576", "1435", "4610", "3575", "7778", "7882", "0995", "2530", "4080", "9121", "2883", "2288", "4038", "4696", "3088", "9969", "0319", "3695", "9068", "2996", "3706", "4514", "1997", "9416", "8519", "7593", "6144", "9204", "7276", "7454", "1911", "7241", "6848", "3437", "2575", "0182", "1035", "9870", "3126", "1444", "7577", "7107", "6910", "1786", "3762", "6602", "4867", "8127", "7572", "3987", "2933", "1822", "7119", "2904", "2312", "8021", "4550", "5577", "9951", "8320", "1090", "3133", "9068", "5969", "0148", "4633", "2948", "3739", "2202", "8040", "1023", "0743", "0785", "7750", "1560", "5829", "4422", "8909", "0425", "5764", "1665", "8510", "7969", "1355", "2054", "7243", "9763", "6613", "9556", "3754", "5298", "7151", "4893", "0650", "3156", "8354", "5402", "5330", "2933", "7797", "5211", "9946", "6790", "6243", "6905", "1043", "5964", "9680", "9755", "4808", "4042", "5408", "5167", "0102", "3095", "3845", "2437", "4943", "6936", "5030", "5733", "0928", "4513", "7545", "2749", "8234", "5167", "6357", "6007", "4828", "2466", "8060", "9782", "6031", "0396", "5459", "6029", "8861", "8122", "2535", "2950", "4952", "2103", "9757", "9438", "0120", "6905", "4829", "2355", "3907", "8874", "1844", "9059", "3222", "9640", "9944", "9949", "3588", "6333", "8251", "0870", "5978", "7930", "5092", "3374", "0878", "0812", "2045", "0371", "3388", "1263", "0707", "8966", "5442", "7232", "6605", "0994", "3081", "7716", "1164", "8876", "1361", "8576", "2624", "1209", "5535", "6751", "9688", "0944", "7083", "9524", "9135", "6330", "7792", "1964", "7744", "0367", "1488", "4668", "7170", "6968", "0798", "6768", "0303", "1811", "5270", "3137", "0502", "2239", "3746", "8902", "1447", "6048", "3822", "6007", "8217", "0430", "1387", "3421", "9992", "0204", "1422", "4696", "1302", "3162", "5705", "3889", "5290", "7864", "3786", "9341", "3398", "6967", "3572", "6372", "6602", "1678", "4576", "1164", "2920", "6201", "7129", "7526", "6517", "4989", "2443", "1106", "5277", "7082", "3656", "5817", "8557", "0457", "2939", "2257", "3986", "7223", "2786", "0423", "7834", "0571", "0189", "1861", "2937", "8069", "6279", "5643", "2147", "1970", "7323", "4413"];

return [
    ['Solution', 'openLock'],
    [[], [$locks, "1064"]],
    [null, 9]
];
