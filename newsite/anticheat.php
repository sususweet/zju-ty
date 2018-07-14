<?php
$fp = fopen('wescms/tmp/anticheat.log', 'a');
fwrite($fp, date('Y-m-d H:i:s') . ' - ' . $_SERVER['REMOTE_ADDR'] . "\n");
fclose($fp);
