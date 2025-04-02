<?
$e=getEntry(group2dn('#rightsList'), 'member');
$e=$e[$e[0]];
for($i=$e['count']-1; $i>=0; $i--):
 $q=ldap_read($CFG->h, $e[$i], "objectClass=Group", Array('sAMAccountName', 'description'));
 $eg=ldap_get_entries($CFG->h, $q);
 $eg=$eg[0];
 ldap_free_result($q);
 if($g=utf2str($eg['samaccountname'][0]))
   $CFG->rList[$g]=utf2str($eg['description'][0]);
endfor;
//sort($CFG->rList);
?>
