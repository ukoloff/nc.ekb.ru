<?
global $CFG;

//if(!function_exists('sqlite3_open')) dl('sqlite3.so');

//$Success=ldap_delete($CFG->h, $CFG->udn)? 1 : 0;
$Success=ldapDel($CFG->udn);
if(!$Success)
  $CFG->ldapError='Îøèáêà '.ldap_errno($CFG->h).': '.ldap_error($CFG->h);

/*
$z=sqlite3_open(dirname(__FILE__).'/log/log.sq3');
sqlite3_exec($z, "Insert Into Log(Time, u, ip, Computer, ua, Success) Values (datetime('now', 'localtime'), ".
    sqlite3_escape($CFG->u).", ".sqlite3_escape($_SERVER['REMOTE_ADDR']).", ".
    sqlite3_escape($CFG->params->u).", ".sqlite3_escape($_SERVER['HTTP_USER_AGENT']).", $Success)");
*/

$ip=$_SERVER['REMOTE_ADDR'];
if($ip==$_SERVER["SERVER_ADDR"]) $ip=$_SERVER["HTTP_X_FORWARDED_FOR"];
$ip=AddSlashes($ip);

mysql_query("Insert Into uxmJournal.delHost(u, ip, Computer, ua, Success) Values('".
    AddSlashes($CFG->u)."', '$ip', '".AddSlashes($CFG->params->u)."', '".
    AddSlashes($_SERVER['HTTP_USER_AGENT'])."', $Success)");

if($Success)
  Header("Location: ../ou/".hRef('x', 'search', 'in', 'c', 'q', $CFG->params->u));

/*
function sqlite3_escape($S)
{
 if(isset($S)) return "'".strtr($S, array("'"=>"''"))."'";
 return 'NULL';
}
*/

function ldapDel($dn)
{
 global $CFG;
 $q=ldap_list($CFG->h, $dn, '(objectClass=*)', array('1.1'));
 for($e=ldap_first_entry($CFG->h, $q); $e; $e=ldap_next_entry($CFG->h, $e))
   if(!ldapDel(ldap_get_dn($CFG->h, $e))) return 0;
 return ldap_delete($CFG->h, $dn);
}
?>
