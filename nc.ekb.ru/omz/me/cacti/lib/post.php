<?
$mode='stas'==$CFG->u? 'a':'m';

do{
 $r=rnd();
 mysql_query("Insert Into cacti(xtime, hash, mode) Values(Now()+Interval 1 Minute, '$r', '$mode')");
}while(!mysql_affected_rows());

mysql_query("Insert Into uxmJournal.cacti(u, mode, IP) Values('".AddSlashes($CFG->u)."', '$mode', '".AddSlashes($_SERVER[REMOTE_ADDR])."')");
header("Location: https://cacti.ekb.ru/cacti/uxm/?id=$r");

exit;

function rnd()
{
 $f=fopen('/dev/urandom', 'r');
 return preg_replace('/\W/', '', base64_encode(sha1(fread($f, 4).microtime(), true)));
}

?>