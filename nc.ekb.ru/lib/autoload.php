<?
if(preg_match('/^192\\.168\\./', $_SERVER['REMOTE_ADDR']) or $_SERVER["SERVER_ADDR"]==$_SERVER["REMOTE_ADDR"])
  $CFG->intraNet=1;

LoadLib('/ldap');
LoadLib('/menu');
LoadLib('/http');
LoadLib('/mysql');
LoadLib('/sqlite3_fix');

$CFG->Menu=&new menuTree();
Authorized();

# Загружает .php файл из (под)папки /lib/
function LoadLib($Name)
{
 $Dir=dirname($Name);
 $Name=basename($Name);

 $scriptName=$_SERVER['SCRIPT_NAME'];
 if(!$scriptName) $scriptName='/index.php';

 if('/'==$Dir{0}) $Dir=preg_replace('|/$|', '', preg_replace('|(/lib)?/[^/]*$|', '', __FILE__).$Dir);
// else $Dir=preg_replace('|/(lib/)?[^/]*$|', '', $scriptName)."/$Dir";
// echo ">$Name :: $Dir \n";
 require_once("$Dir/lib/$Name.php");
}

# Посланы ли браузером правильные имя/пароль?
function Authorized()
{
 global $CFG;
 $CFG->Auth=0;
 $CFG->u='';
 if($u=$_SERVER['PHP_AUTH_USER']):
  if(!user2dn($u)) return 0;
  $p=$_SERVER['PHP_AUTH_PW'];
  if(ldapCheckPass($u, $p))
   $CFG->legacyAuth=0;
#  elseif(sqlCheckPass($u, $p))
#   $CFG->legacyAuth=1;
  else
   return 0;
  $CFG->u=$u;
  $CFG->strongAuth=1;
  sqlUpdateStat();
  return $CFG->Auth=1; 
 endif;
 return 0;
/*
 $u=sqlGetDialupUser();
 if(!$u or !user2dn($u)) return 0;
 $CFG->u=$u;
 $CFG->weakAuth=1;
 return $CFG->Auth=-1;
*/
}

?>
