<?php
$str = "abcabcab";
echo substr_count($str,"abcab"); // 此函数不会对重叠的子字符串计数
?>