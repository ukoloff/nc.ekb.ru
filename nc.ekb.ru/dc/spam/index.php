<?
require('../../lib/uxm.php');

uxmHeader('Рассылка спама');
?>
<H1>Рассылка спама</H1>
<Small>
<?
$q=ldap_search($CFG->h, $CFG->Base, '(&(objectClass=User)(!(objectClass=Computer))(sn=*))', 
    Array('sAMAccountName', 'userAccountControl', 'msSFU30NisDomain', 'displayName'));
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($q);
for($i=$e['count']-1; $i>=0; $i--):

 $x=$e[$i];
 if(!$x['mssfu30nisdomain'][0]) continue;
// if($x['useraccountcontrol'][0] & uac_ACCOUNTDISABLE)echo $x['samaccountname'][0], " ";
 $z=new dn($x['dn']);
 $z=$z->ufn();
 if(substr($z->str(), 0, 7)=='Внешние/') continue;
 echo "<A hRef='mailto:", $x['samaccountname'][0], "@ekb.ru'>", utf2html($x['displayname'][0]), "</A> ";
endfor;

?>
</Small>
</body></html>
