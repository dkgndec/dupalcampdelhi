<?php
$user = 'reporter';
$pass = '0vl6iqMSyr';
$cmd = "svn --password $pass --username $user up;";
$tmp =  exec($cmd, $output);
echo implode("<br>", $output);
?>


