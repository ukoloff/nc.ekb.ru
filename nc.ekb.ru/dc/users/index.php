<?
global $CFG;
require("../../lib/uxm.php");
//AuthorizedOnly();

$CFG->Z=!!trim($_REQUEST['z']);
$CFG->J=isset($_REQUEST['j']);
uxmHeader('Список пользователей');
?>
<H1>Список пользователей</H1>
<Table Border CellSpacing='0'>
<TR Class='tHeader'>
<TH>Отдел</TH>
<TH>Код</TH>
<TH>u</TH>
<? if($CFG->Z): ?><TH>Script</TH><? endif; ?>
<? if($CFG->J): ?><TH>Фото</TH><? endif; ?>
<TH>Таб</TH>
<TH>Ф</TH>
<TH>И</TH>
<TH>О</TH>
<TH>Должность</TH>
</TR>
<?
$z=new ufn();
$z=$z->dn();
listOU($z->str());

function listOU($dn, $n=null)
{
 global $CFG;
 $ufn=new dn($dn);
 $ufn=$ufn->ufn();
 $ufn=$ufn->str();
 if('Внешние'==$ufn) return;
 if($ufn):
  $q=ldap_read($CFG->h, $dn, 'objectClass=*', Array('l'));
  $e=ldap_get_entries($CFG->h, $q);
  ldap_free_result($q);
// print_r($e);
  $oun=$e[0]['l'][0];
 endif;
 if(!$oun)$oun=$n;
// echo "<LI>", htmlspecialchars($ufn), "[$oun]";
 $q=ldap_list($CFG->h, $dn, 'objectClass=user');
 $e=ldap_get_entries($CFG->h, $q);
 ldap_free_result($q);
 unset($X);
 for($i=$e['count']-1; $i>=0; $i--):
  $u=$e[$i];
  if($u['useraccountcontrol'][0]& uac_ACCOUNTDISABLE) continue;
  if(!$u['sn'][0]) continue;
//  echo "<LI>", utf2html($u['samaccountname'][0]);
  $X[utf2str($u['cn'][0])]=$u;
 endfor;
 ksort($X);
 foreach($X as $k=>$v):
  echo "<TR><TD>", 
    htmlspecialchars($ufn), "<BR /></TD><TD>",
    $oun, "<BR /></TD><TD>",
    utf2html($v['samaccountname'][0]), '<BR /></TD><TD>';
//    utf2html($v['cn'][0]), '<BR /></TD><TD>', 
  if($CFG->Z) echo utf2html($v['scriptpath'][0]), "<BR /></TD><TD>";
  if($CFG->J) echo "<Center>", $v['jpegphoto']['count']? "<A hRef='/abook/jpg&u=".$v['samaccountname'][0]."'>+</A>":'-',
    "<BR /></Center></TD><TD>";
  echo
    utf2html($v['employeeid'][0]), '<BR /></TD><TD>', 
    utf2html($v['sn'][0]), '<BR /></TD><TD>', 
    utf2html($v['givenname'][0]), '<BR /></TD><TD>', 
    utf2html($v['middlename'][0]), '<BR /></TD><TD>', 
    utf2html($v['title'][0]), //'<BR /></TD><TD>', 
    "<BR /></TD></TR>\n";
 endforeach;

 unset($X);
 $q=ldap_list($CFG->h, $dn, 'objectClass=organizationalUnit');
 $e=ldap_get_entries($CFG->h, $q);
 ldap_free_result($q);
// print_r($e);
 for($i=$e['count']-1; $i>=0; $i--)
  $X[utf2str($e[$i]['ou'][0])]=$e[$i]['dn'];
 ksort($X);
 foreach($X as $k=>$v)
  listOU($v, $oun);
}
?>
</Table>
<Center><Form id='HideMe'>
<Input Type='Button' Value=' Убрать всё лишнее ' onClick='Clear()' />
</Form>
<Script><!--
function Clear()
{
 findId('Menu').style.display='none';
 findId('HideMe').style.display='none';
 document.body.style.marginLeft=0;
}
//--></Script>
</body></html>

