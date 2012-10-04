<?php
$t1 = strtotime(date('Y-m-d h:i:s'));
echo strtotime(date('Y-m-d h:i:s')).'|'.date('Y-m-d h:i:s');
date_default_timezone_set("Asia/Kathmandu");
echo '<br />';
$t2 = strtotime(date('Y-m-d h:i:s'));
echo strtotime(date('Y-m-d h:i:s')).'|'.date('Y-m-d h:i:s');
echo '<br />';
echo $diff = $t1-$t2;
echo '||';
echo $h = (int)$diff/60/60;
echo '<br />';
echo date('Y-m-d h:i:s', $t2-$t1);

?>