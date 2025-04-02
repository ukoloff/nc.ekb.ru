<?
$Success=ldapDel($CFG->udn);
if(!$Success)
  $CFG->ldapError='Îøèáêà '.ldap_errno($CFG->h).': '.ldap_error($CFG->h);

$ip=$_SERVER['REMOTE_ADDR'];
if($ip==$_SERVER["SERVER_ADDR"]) $ip=$_SERVER["HTTP_X_FORWARDED_FOR"];
$ip=AddSlashes($ip);

mysql_query("Insert Into uxmJournal.delHost(u, ip, Computer, ua, Success) Values('".
    AddSlashes($CFG->u)."', '$ip', '".AddSlashes($CFG->params->u)."', '".
    AddSlashes($_SERVER['HTTP_USER_AGENT'])."', $Success)");

if($Success)
  Header("Location: ../ou/".hRef('x', 'search', 'in', 'C', 'q', $CFG->params->u));

function ldapDel($dn)
{
 global $CFG;
 $q=ldap_list($CFG->AD->h, $dn, '(objectClass=*)', array('1.1'));
 for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e))
   if(!ldapDel(ldap_get_dn($CFG->AD->h, $e))) return 0;
 return ldap_delete($CFG->AD->h, $dn);
}

?>
