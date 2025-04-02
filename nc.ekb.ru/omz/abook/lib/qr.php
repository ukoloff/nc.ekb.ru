<?
$e=getEntry($CFG->udn);

$V="BEGIN:VCARD\nN";
foreach(Array('sn', 'givenname', 'middlename') as $n=>$k)
 $V.=($n?';':':').qp($e[$k][0]);

if($x=$e[mail])
 $V.="\nEMAIL:".qp($x[0]);

if($x=$e[title])
  $V.="\nTITLE:".qp($x[0]);

if($x=$e[telephonenumber]):
  $x=$x[0];
  if(7==strlen(preg_replace('/\D/', '', $x))) $x='+7(343)'.trim($x);
#  $V.="\r\nTEL;WORK;VOICE:".qp($x);
  $V.="\nTEL;WORK:".qp($x);
endif;

if($x=$e[company])
  $V.="\nORG:".qp($x[0]);

$V.="\nEND:VCARD";

if('!'==trim($_REQUEST[qr])):
 header('Content-Type: text/plain; charset="utf-8"'); 
 echo $V; 
 exit;
endif;
/********************************
LoadLib('/qrcode');
$qr=new QR($V, QR::ECC_M);
Header('Content-Type: image/gif');

echo $qr->image($n);
********************************/
Header('Content-Type: image/png');
$n=(int)trim($_REQUEST[qr]);
if($n<1) $n=2;
$z=proc_open("/usr/bin/qrencode -s $n -o -", Array(Array('pipe', 'r'), Array('pipe', 'w')),  $pipes);
fwrite($pipes[0], $V);
fclose($pipes[0]);
echo stream_get_contents($pipes[1]);
fclose($pipes[1]);
proc_close($z);

function myHex($c)
{
 return '='.strtoupper(bin2hex($c[0]));
}

# Raw Quoted-Printable encoding
function _qp($s)
{
 return preg_replace_callback('/([:;="\'\x00-\x1F])/', myHex, $s);
}

function qp($s)
{
 return $s;
}

?>
