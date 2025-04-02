<?
ini_set('display_errors', true);
ini_set('log_errors', false);

global $CFG;
require("../../lib/uxm.php");

uxmHeader('Копирование фоток');
?>
<H1>Копирование фоток</H1>
<Table Border CellSpacing='0'>
<TR Class='tHeader'>
<TH>№</TH>
<TH>Отдел</TH>
<TH>Код</TH>
<TH>u</TH>
<TH>Таб</TH>
<TH>Ф</TH>
<TH>И</TH>
<TH>О</TH>
<TH>Должность</TH>
<TH>ВОХР</TH>
</TR>
<?
LoadLib('../ext/jpeg.v2010');


$z=new ufn();
$z=$z->dn();
$CFG->N=0;
listOU($z->str());

function listOU($dn, $n=null)
{
 global $CFG;
 $ufn=new dn($dn);
 $ufn=$ufn->ufn();
 $ufn=$ufn->str();
// if('Внешние'==$ufn) return;
 if($ufn):
  $q=ldap_read($CFG->h, $dn, 'objectClass=*', Array('l'));
  $e=ldap_get_entries($CFG->h, $q);
  ldap_free_result($q);
// print_r($e);
  $oun=$e[0]['l'][0];
 endif;
 if(!$oun)$oun=$n;
// echo "<LI>", htmlspecialchars($ufn), "[$oun]";
 $q=ldap_list($CFG->h, $dn, '(&(objectClass=user)(sn=*)(!(jpegPhoto=*)))');
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
 if(is_array($X)) ksort($X);
  if(is_array($X))
 foreach($X as $k=>$v):
  $CFG->od=odbtp_prepare('Select ID From pList Where Name=? And FirstName=? And MidName=? And (TabNumber=? Or TabNumber=?) '.
    ' And DataLength(Picture)>0');
  for($i=1; $i<=5; $i++)odbtp_input($CFG->od, $i);
  odbtp_set($CFG->od, 1, utf2str($v['sn'][0]));
  odbtp_set($CFG->od, 2, utf2str($v['givenname'][0]));
  odbtp_set($CFG->od, 3, utf2str($v['middlename'][0]));
  odbtp_set($CFG->od, 4, utf2str($v['employeeid'][0]));
  odbtp_set($CFG->od, 5, '0'.utf2str($v['employeeid'][0]));
  odbtp_execute($CFG->od);
  $voxrID=odbtp_fetch_array($CFG->od);
  if($voxrID):
   $voxrID=$voxrID[0];
   unset($JPG);
   $JPG[]=getJPG($voxrID);
   ldap_modify($CFG->h, $v['dn'], Array('jpegPhoto'=>$JPG));
//   echo "<!-- {$v['dn']} -->";
  endif;
  echo "<TR><TD Align='Right'>", ++$CFG->N, "<BR /></TD><TD>",
    htmlspecialchars($ufn), "<BR /></TD><TD>",
    $oun, "<BR /></TD><TD>",
    "<A Target='uJpeg' hRef='../user/", htmlspecialchars(hRef('x', 'contact', 'u', utf2str($v['samaccountname'][0]))), "'>",
    utf2html($v['samaccountname'][0]), '</A><BR /></TD><TD>';
//    utf2html($v['cn'][0]), '<BR /></TD><TD>', 
  echo
    utf2html($v['employeeid'][0]), '<BR /></TD><TD>', 
    utf2html($v['sn'][0]), '<BR /></TD><TD>', 
    utf2html($v['givenname'][0]), '<BR /></TD><TD>', 
    utf2html($v['middlename'][0]), '<BR /></TD><TD>', 
    utf2html($v['title'][0]), '<BR /></TD><TD>', 
    $voxrID,
    "<BR /></TD></TR>\n";
 endforeach;

 unset($X);
 $q=ldap_list($CFG->h, $dn, 'objectClass=organizationalUnit');
 $e=ldap_get_entries($CFG->h, $q);
 ldap_free_result($q);
// print_r($e);
 for($i=$e['count']-1; $i>=0; $i--)
  $X[utf2str($e[$i]['ou'][0])]=$e[$i]['dn'];
 if(is_array($X))ksort($X);
 if(is_array($X))
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

