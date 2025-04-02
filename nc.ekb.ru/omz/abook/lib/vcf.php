<?
$e=getEntry($CFG->udn);
$u=utf2str($e['samaccountname'][0]);
if(true):
  header("Content-Type: text/directory; charset=\"Windows-1251\"; profile=\"vCard\"");
  header("Content-disposition: attachment; filename=\"$u.vcf\"");
else:
  echo "<PRE>\r\n";
endif;

echo "BEGIN:VCARD\r\nVERSION:2.1\r\nUID:$u\r\n";

$QP=';ENCODING=QUOTED-PRINTABLE:';

if(!($x=$e['displayname'][0]))$x=$x=$e['cn'][0]; 
echo "FN$QP", utf2qp($x), "\r\n";

$x='';
foreach(Array('sn', 'givenname', 'middlename') as $k)
    $x.=';'._qp(utf2str($e[$k][0]));
echo "N$QP", wrap_qp(substr($x, 1)), "\r\n";

if($x=$e['mail'])
  echo "EMAIL;PREF;INTERNET:", utf2str($x[0]), "\r\n";

if($x=$e['title'])
  echo "TITLE$QP", utf2qp($x[0]), "\r\n";

if($x=$e['telephonenumber'][0]):
  $x=utf2str($x);
  if(7==strlen(preg_replace('/\D/', '', $x))) $x='+7(343)'.trim($x);
  echo "TEL;WORK;VOICE$QP", qp($x), "\r\n";
endif;

if($x=$e['company'][0])
  echo "ORG$QP", utf2qp($x), "\r\n";

$x=new DN($CFG->udn);
$x=$x->ufn();
if(!preg_match('|^Внешние/|', $x->str())):

  $x=';'._qp(utf2str($e['physicaldeliveryofficename'][0]));
  foreach(split(';', 'пер. Хибиногорский, 33;Екатеринбург;Свердловская область;620010;Россия')as $k)
    $x.=';'._qp($k);
  echo "ADR;WORK$QP", wrap_qp($x), "\r\n";

  echo "URL;WORK:http://ekb.ru\r\n";
endif;

if($x=$e['description'])
  echo "NOTE$QP", utf2qp($x[0]), "\r\n";

/*
if($e['employeeid'][0] and file_exists($x=$_SERVER['DOCUMENT_ROOT']."/img/photo/".utf2str($e['employeeid'][0]).".jpg"))
  echo "PHOTO;ENCODING=B;TYPE=JPEG:\r\n ",
    trim(chunk_split(base64_encode(file_get_contents($x)), 60, "\r\n ")), "\r\n";
*/
LoadLib('/userPhoto');
$photo=getPhoto($CFG->udn);
if(strlen($photo))
  echo "PHOTO;ENCODING=B;TYPE=JPEG:\r\n ",
    trim(chunk_split(base64_encode($photo), 60, "\r\n ")), "\r\n";

echo "REV:", gmstrftime('%Y%m%dT%H%M%SZ'), "\r\nEND:VCARD\r\n";

#echo "\r\n"; print_r($e);

function myHex($c)
{
 return '='.strtoupper(bin2hex($c[0]));
}

# Raw Quoted-Printable encoding
function _qp($s)
{
 return preg_replace_callback('/([:;="\'\x00-\x1F])/', myHex, $s);
}

# Wrap Quoted-Printable line
function wrap_qp($s)
{
 define(MAXLEN, 50);
 $r='';
 while(strlen($s)>MAXLEN):
  $i=MAXLEN;
  if('='==$s{$i-1}) $i--;
  elseif('='==$s{$i-2}) $i-=2;
  $r.=substr($s, 0, $i)."=\r\n";
  $s=preg_replace_callback('/^\s/', myHex, substr($s, $i));
 endwhile;
 return $r.$s;
}

# Quoted-Printable encoding+line split
function qp($s)
{
 return wrap_qp(_qp($s));
}

function utf2qp($s)
{
 return qp(utf2str($s));
}
?>
