<?
require('x.php');

$q=ldap_search($CFG->h, $CFG->Base, 'objectClass=User', Array('sAMAccountName', 'cn', 'description', 'info'));
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($q);
for($i=$e['count']-1; $i>=0; $i--):
 $x=$e[$i];
 $ufn=new dn($x['dn']);
 $ufn=$ufn->ufn();
 $ufn=$ufn->str();
 if('/'==$ufn{0}) continue;
 if(preg_match('(^ОИТ/System/Свалка/)', $ufn)) continue;
 $u=utf2str($x['samaccountname'][0]);
 $q=mysql_query("Select * from users Where u='".AddSlashes($u)."'");
 if(mysql_num_rows($q)<1) continue;
 echo "Replace Into Migrate(u, cn, ou, description, info) Values('",
  AddSlashes($u), "', '",
  AddSlashes(utf2str($x['cn'][0])), "', '",
  AddSlashes($ufn), "', '",
  AddSlashes(utf2str($x['description'][0])), "', '",
  AddSlashes(utf2str($x['info'][0])), "');\n";

endfor;
?>
