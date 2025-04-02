<?
wwwAuth();

if(!isset($_COOKIE[adminer_lang]))$_COOKIE[adminer_lang]='en';
ini_set('mssql.charset', 'UTF-8');

function adminer_object()
{
 class myAdminer extends Adminer
 {
  function name()
  {
   return 'Adminer@uxm';
  }
/*
  function login($login, $password)
  {
   if('sqlite'==$_POST['auth[driver]']):
    $_POST['auth[server]']='';
    $_POST['auth[username]']='';
    $_POST['auth[password]']='';
   endif;
   return true;
  }
*/
  function credentials()
  {
   if(DRIVER=='server' and SERVER=='!') return Array('dbserv', 'PMA', 'zyJnySUmwK8bdqFf');
   if(DRIVER=='mssql') return Array(SERVER, "OMZGLOBAL\\".$_SERVER[PHP_AUTH_USER], $_SERVER[PHP_AUTH_PW]);
//   if(DRIVER=='sqlite' and SERVER=='CA') return Array(SERVER, '', '', '/home/uxmCA/db/pub/pub.db');
   return parent::credentials();
  }

  function head()
  {
   echo "<Script><!--\njushRoot=0;\n//--></Script>";
   return true;
  }
 }
 return new myAdminer;
}

include(dirname(__FILE__).'/adminer-3.6.3.php');

function A1($user, $pass)
{
 if(!strlen($user) or !strlen($pass)) return;
 $DC='OMZGLOBAL';
 for($i=5; $i>0; $i--)
   if($h=ldap_connect($DC) and  ldap_set_option($h, LDAP_OPT_REFERRALS, 0) and ldap_set_option($h, LDAP_OPT_PROTOCOL_VERSION, 3) and
    ldap_start_tls($h)) break;
 if(!$h) return;
 return ldap_bind($h, $DC."\\".$user, $pass);
}

function A2($user)
{
 return 's.ukolov1'==$user;
}

function wwwAuth()
{
 if(!A1($u=$_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) or !A2($u)):
  Header("WWW-Authenticate: Basic realm=Adminer");
  Header("HTTP/1.0 401");
  exit;
 endif;
}

?>
