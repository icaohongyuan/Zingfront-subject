<?php
$s = $_POST['word1'];
$t = $_POST['word2'];
if (empty($s) || empty($t)) {
    echo '请输入两个英文语句!';die;
}
$second_word = getSecondWord($s, $t);
echo '第⼆⻓公共单词为：', $second_word;
function getSecondWord($s, $t)
{
    // 字符串不为空
    if (empty($s)) return null;
    if (empty($t)) return null;
    // 1. 字符串变数组
    $arr1 = explode(' ', $s);
    $arr2 = explode(' ', $t);
    // 至少两个单词
    if (count($arr1) < 2) return null;
    if (count($arr2) < 2) return null;
    // 2. 去重，省去多余时间
    $arr1 = array_unique($arr1);
    $arr2 = array_unique($arr2);
    // 3. 排序，按单词长度降序排序
    usort($arr1, 'compare');
    usort($arr2, 'compare');
    // 相同返回第二个
    if ($arr1 == $arr2) return $arr1[1];
    // 4. 返回出字符串最长的前两个
    $arr = [];
    foreach ($arr1 as $k => $v) {
        foreach ($arr2 as $kk => $vv) {
            if ($v == $vv) {
                $arr[] = $v;
            }
        }
    }
    if (count($arr) > 1) {
        return $arr[1];
    } else {
        return null;
    }
}

// 比较函数
function compare($a, $b)
{
    if (strlen($a) == strlen($b)) {
        return 0;
    }
    return (strlen($a) < strlen($b)) ? 1 : -1;
}