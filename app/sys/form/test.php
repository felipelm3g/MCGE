<?php

$str = 625439210;
$carac = strlen($str);
$dif = 11 - intval($carac);
for ($i = 1; $i <= $dif; $i++) {
    $str = "0" . $str;
}

echo $str;
//echo base64_encode($str);
?>

