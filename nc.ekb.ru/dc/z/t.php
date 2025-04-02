<?
exit;
global $CFG;
require("../../lib/uxm.php");
if('stas'!=$CFG->u) exit;

$f=fopen("t.csv", "r");
while(!feof($f)):
 list($tab, $tit)=split(';', fgets($f), 2);
 $tab=trim($tab); $tit=trim($tit);
 if(0==strlen($tab)) continue;
 
 $q=ldap_search($CFG->h, $CFG->Base, "(&(ObjectClass=user)(employeeID=$tab))");
 $e=ldap_get_entries($CFG->h, $q);
 ldap_free_result($q);
 for($i=$e['count']-1; $i>=0; $i--):
  echo "<LI>", utf2html($e[$i]['samaccountname'][0]), "[$tab]:=$tit\n";
  ldap_modify($CFG->h, $e[$i]['dn'], Array('title'=>utf8($tit)));
 endfor;
endwhile;
?>
