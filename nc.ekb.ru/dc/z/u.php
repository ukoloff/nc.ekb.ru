<Table Border CellSpacing='0'>
<TR>
<!--<TH>Ф.И.О.</TH>-->
<TH>Login</TH>
<TH>Фамилия</TH>
<TH>Имя</TH>
<TH>Отчество</TH>
<TH>Таб. номер</TH>
<TH>Подразделение</TH>
</TR>
<?

require("../../lib/uxm.php");

$CFG->Users=Array();

function addUsers($ou)
{
 global $CFG;

 $q=ldap_list($CFG->h, $ou, "(&(objectClass=User)(!(objectClass=Computer)))", Array());
 $e=ldap_get_entries($CFG->h, $q);
 ldap_free_result($q);
 for($i=$e['count']-1; $i>=0; $i--):
  $ee=$e[$i];
  if($ee['useraccountcontrol'][0]&uac_ACCOUNTDISABLE) continue;
  $z=new DN($ee['dn']);
  $z->Cut();
  $z=$z->ufn();
  echo "<TR><TD>", /* utf2str($ee['cn'][0]), 
    "<BR /></TD>\n<TD>", */utf2str($ee['samaccountname'][0]),
    "<BR /></TD>\n<TD>", utf2str($ee['sn'][0]),
    "<BR /></TD>\n<TD>", utf2str($ee['givenname'][0]), 
    "<BR /></TD>\n<TD>", utf2str($ee['middlename'][0]), 
    "<BR /></TD>\n<TD>", utf2str($ee['employeeid'][0]), 
    "<BR /></TD>\n<TD>", htmlspecialchars($z->str()), 
    "<BR /></TD></TR>";
 endfor;
 
 $q=ldap_list($CFG->h, $ou, "objectClass=organizationalUnit", Array());
 $e=ldap_get_entries($CFG->h, $q);
 ldap_free_result($q);
 for($i=$e['count']-1; $i>=0; $i--):
  addUsers($e[$i]['dn']);
 endfor;
}

addUsers("dc=lan,dc=uxm");

?>
</Table>