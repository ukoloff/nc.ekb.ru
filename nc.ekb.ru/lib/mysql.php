<? // Библиотека доступа к MySQL
if(!function_exists('mysql_pconnect'))	dl('mysql.so');

require_once(dirname(__FILE__).'/mysql.ini.php');
mysql_pconnect($host, $user, $pass);
mysql_select_db($db);

function sqlGet($SQL)
{
 $q=mysql_query($SQL);
 $r=mysql_fetch_object($q);
 if(!$r) return;
 switch(count($a=get_object_vars($r)))
 {
  case 0: return;
  case 1: reset($a); return current($a);
 }
 return $r;
}

function sqlCheckPass($u, $pass)
{
 if(!$u) return;
 $p=sqlGet("Select pass From users Where u='".AddSlashes($u)."'");
 if(!$p) return;
 if(crypt($pass, $p)!=$p) return 0;
 sqlUpdatePass($u, $pass);
 return 1;
}

// "Упрощённая" авторизация - по IP-адресу для dialup-пользователей
function sqlGetDialupUser()
{
 $ip=$_SERVER['REMOTE_ADDR'];
 if($ip==$_SERVER["SERVER_ADDR"]) $ip=$_SERVER["HTTP_X_FORWARDED_FOR"];
 $ip=AddSlashes($ip);
 return sqlGet(<<<SQL
Select u From Connections, ActiveConnections
Where Connections.connId=ActiveConnections.connId And ip='$ip'
Order By StartTime Desc
SQL
);
}

function sqlUpdatePass($u, $p)
{
 mysql_query("Update users Set smbPass='".base64_encode($p)."' Where u='".AddSlashes($u)."'");
}

function sqlUpdateStat()
{
 global $CFG;
 $ip=$_SERVER["REMOTE_ADDR"];
 if($ip==$_SERVER["SERVER_ADDR"])$ip='127.0.0.1';
 $ip=AddSlashes($ip);
 $u=AddSlashes($CFG->u);
 mysql_query("Update ipUse Set www=1 Where Month=Date_Format(Now(), '%Y%m') And u='$u' And ip='$ip'");
 if(mysql_affected_rows()<=0)
   mysql_query("Insert Into ipUse(Month, u, ip, www) Values(Date_Format(Now(), '%Y%m'), '$u', '$ip', 1)");
}

?>
