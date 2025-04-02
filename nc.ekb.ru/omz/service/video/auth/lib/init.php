<?
$CFG->AAA=1;
$CFG->title='Вход в видеонаблюдение';

LoadLib('../db');
LoadLib('ntlm'==$_REQUEST['x']?'ntlm':'basic');

function R4()
{
 $f=fopen('/dev/urandom', 'r');
 while(preg_match('/\W/', $s=base64_encode(fread($f, 3)))){}
 fclose($f);
 return $s;
}

function newR4()
{
 do{ $r0=mssql_fetch_row(mssql_query('Select Count(*) From Auth Where hash='.dbEscape($r=R4())));
 }while($r0[0]>0);
 return $r;
}

function isDirector($u)
{
 $z=new DN(user2dn($u));
 $z->Cut();
 $z=$z->ufn();
 return 'Дирекция'==$z->str()?1:0;
}

function doAuth($u, $IP, $ua, $meth=null)
{
 $r=newR4();

 $e=getEntry(user2dn($u), 'mail');
 if($e)$e=utf2str($e['mail'][0]);

 mssql_query('Insert Into Auth(hash, xtime, u, porn, D, IP, Method, mail) Values('.
    dbEscape($r).', DateAdd(second, 15, GetDate()), '.dbEscape($u).", ".isDirector($u).
    ", ".getDispatcher($u).", ".dbEscape($IP).', '.dbEscape($meth).", ".dbEscape($e).")");

 $meth=$meth?"'".AddSlashes($meth)."'":'NULL';

 mysql_query("Insert Into uxmJournal.videoAuth(u, IP, ua, Method) Values('".
    AddSlashes($u)."', '".AddSlashes($IP)."', '".
    AddSlashes($ua)."', $meth)");

 return $r;
}

?>
