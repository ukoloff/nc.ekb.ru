<?
$z=new DN(user2dn($CFG->u));
$z->Cut();
$z=$z->ufn();
$z='Дирекция'==$z->str()?1:0;
$D=(int)$CFG->Dispatcher;
//echo $CFG->u, " [", $z, "]";

do{ $r0=mssql_fetch_row(mssql_query('Select Count(*) From Auth Where hash='.dbEscape($r=R4())));
}while($r0[0]>0);

mssql_query('Insert Into Auth(hash, xtime, u, porn, D, IP) Values('.
    dbEscape($r).', DateAdd(second, 15, GetDate()), '.dbEscape($CFG->u).", $z, $D, ".dbEscape($_SERVER['REMOTE_ADDR']).')');

if('POST'==$_SERVER['REQUEST_METHOD']) $To='http://video.ekb.ru/i/';
else $To=$_SERVER['HTTP_REFERER'];

mysql_query("Insert Into uxmJournal.videoAuth(u, IP, ua) Values('".
    AddSlashes($CFG->u)."', '".AddSlashes($_SERVER['REMOTE_ADDR'])."', '".
    AddSlashes($_SERVER['HTTP_USER_AGENT'])."')");

Header("Location: $To".(substr($To, -1)=='/'?'?':'&')."uid=".urlencode($r));

function R4()
{
 $f=fopen('/dev/urandom', 'r');
 while(preg_match('/\W/', $s=base64_encode(fread($f, 3)))){}
 fclose($f);
 return $s;
}
?>
