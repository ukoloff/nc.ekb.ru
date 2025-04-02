<Table Border>
<?

require("../../lib/uxm.php");
LoadLib('/ldapmod');
/*
$x=user2dn('sansan');
$z=getEntry($x);
print_r($z);
*/

/*
$q=ldap_search($CFG->h, "dc=lan,dc=uxm", "anr=aba*", Array());
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($e);
for($i=$e['count']-1; $i>=0; $i--):
 $x=$e[$i];
 echo "<LI>", utf2str($x['dn']), "\n";
//### ldap_delete($CFG->h, $x['dn']);
endfor;
*/

$Names=Array(
'Бегунова Наталия Георгиевна',
'Горшенева Наталья Андреевна',
'Кадушкина Ирина Владимировна',
'Кузнецова Ирина Васильевна',
'Лебедев Александр Алексеевич',
'Пономарева Галина Валентиновна',
'Попова Лариса Валентиновна',
'Толкачева Надежда Гавриловна',
);

$g=group2dn('ОГС');
echo $g, "<HR />\n";

foreach($Names as $s):
 list($f, $n, $o)=preg_split('/\\s+/', $s);
 $q=ldap_search($CFG->h, "dc=lan,dc=uxm", "(&(objectClass=user)(sn=".utf8($f).")(givenName=".utf8($n)."))", Array());
 $i=ldap_count_entries($CFG->h, $q);
 unset($udn);
 if(1==$i):
  $udn=ldap_get_dn($CFG->h, ldap_first_entry($CFG->h, $q));
#  ldapGroupAdd($g, $udn);
  $udn='+';
 endif;
 ldap_free_result($q);

 echo "<TR><TD>$s</TD><TD>$f</TD><TD>$n</TD><TD>$i</TD><TD>", utf2str($udn), "</TD></TR>\n";
endforeach;

?>
</Table>
