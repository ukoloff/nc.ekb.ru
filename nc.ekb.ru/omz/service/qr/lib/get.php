<?
$q=trim($_REQUEST[q]);
if(!$q) return;

$x=(int)trim($_REQUEST[x]);
if($x<1) $x=4;
/**************************
LoadLib('/qrcode');
$qr=new QR($q);
Header('Content-Type: image/gif');
echo $qr->image($x);
***************************/

Header('Content-Type: image/png');
$z=proc_open("/usr/bin/qrencode -s $x -o -", Array(Array('pipe', 'r'), Array('pipe', 'w')),  $pipes);
fwrite($pipes[0], $q);
fclose($pipes[0]);
echo stream_get_contents($pipes[1]);
fclose($pipes[1]);
proc_close($z);
exit;
?>