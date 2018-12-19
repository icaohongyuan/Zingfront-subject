<?php
$num = $_POST['n'];
// 验证是否为整数
if (floor($num)!=$num){
    echo '请输入 N <= 10000 的整数!';die;
}
printing($num);
// 打印过程
function printing($num)
{
    $arr = decompose($num);
    if ($arr == 'NONE') {
        echo 'NONE';
        die;
    }
    echo '分解组合如下：';
    $group = [];
    foreach ($arr as $v) {
        $group[] = range($v[0], $v[1] + $v[0] - 1);
    }
    echo '（共', count($group), '组）';
    echo '<br>';
    foreach ($group as $k => $v) {
        echo '第' . ($k + 1) . '组：';
        foreach ($v as $vv) {
            echo $vv . ' ';
        }
        echo '<br>';
    }
}
// 分解过程
function decompose($num)
{
    // 连续整数，设初始数为m，有k个数，则末尾数为m+k-1
    // 分正整数和负整数
    // 整数之和 z=（m+m+k-1）*k/2  即：(2m+k-1)*k=z*2
    $arr = [];
    if ($num < 0) {
        for ($i = -1; $i > $num; $i--) {
            for ($j = 2; $j < abs($num); $j++) {
                if (2 * $num == (2 * $i + $j - 1) * $j) {
                    $arr[] = [$i, $j];
                }
            }
        }
    } else {
        for ($i = 1; $i < $num; $i++) {
            for ($j = 0; $j < $num; $j++) {
                if (2 * $num == (2 * $i + $j - 1) * $j) {
                    $arr[] = [$i, $j];
                }
            }
        }
    }
    if (empty($arr)) {
        return 'NONE';
    } else {
        return $arr;
    }
}