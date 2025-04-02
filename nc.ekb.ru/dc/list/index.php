<?
require('../../lib/uxm.php');
//LoadLib('/ldapmod');

//uxmHeader('Список пользователей');

LoadLib('../user/contact');
$X=Array('sAMAccountName'=>'uid');
foreach($CFG->Fields as $k=>$v) $X[$k]=$v;
unset($X['info']);
?>
<H1>Список пользователей</H1>
<Table Border CellSpacing='0' CellPadding='0'><TR Class='tHeader'><TH>N</TH><TH>ou</TH>
<?
foreach($X as $k=>$v) echo "<TH>$v</TH>\n";
echo "</TR>";
$q=ldap_search($CFG->h, $CFG->Base, 
    '(&(objectClass=User)(!(objectClass=Computer))(sn=*))',
    array_keys($X));
$e=ldap_get_entries($CFG->h, $q);
ldap_free_result($q);
for($i=0; $i<$e['count']; $i++):
 $x=$e[$i];
// $eee=getEntry($x['dn'], 'userAccountControl sAMAccountName');
// ldapModify($x['dn'], Array('userAccountControl'=>$eee['useraccountcontrol'][0]|uac_DONT_EXPIRE_PASSWORD));

// if(0==i)ldap_modify($CFG->h, $x['dn'], Array('initials'=>array()));
 $dn=new dn($x['dn']);
 $dn=$dn->ufn();
 $dn->Cut();
 $dn=htmlspecialchars($dn->str());
/*
 $ni=utf2str($x['givenname'][0]);
 $no=utf2str($x['middlename'][0]);
 $n2=utf2str($x['initials'][0]);
 $n2x=($ni or $no)?$ni{0}.'.':'';
 if($no)$n2x.=$no{0}.'.';
 $n2x=($n2x==$n2)?'':'!';
*/
 echo '<TR><TD><A Target="winUser" hRef="../user/', 
    hRef('x', 'contact', 'u', utf2str($x['samaccountname'][0])), '">', $i+1, "</A></TD><TD>$dn<BR /></TD>";
 foreach($X as $k=>$v):
  echo "<TD>", utf2html($x[strtolower($k)][0]), "<BR /></TD>\n";
 endforeach;

 echo "</TR>";
endfor;
?>
</Table>
</body></html>

