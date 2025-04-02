<Table Border>
<?

require("../../lib/uxm.php");

$q=ldap_search($CFG->h, "dc=lan,dc=uxm", "scriptPath=*", Array());
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($e);
for($i=$e['count']-1; $i>=0; $i--):
 $x=$e[$i];
 echo "<LI>", utf2str($x['dn']), "\n";
//### ldap_delete($CFG->h, $x['dn']);
endfor;

?>
