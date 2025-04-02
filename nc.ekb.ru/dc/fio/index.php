<?
exit;
setlocale(LC_ALL, "ru_RU.cp1251");
require('../../lib/uxm.php');

if('POST'==$_SERVER['REQUEST_METHOD']):
 LoadLib('/ldapmod');
 for($i=1; ; $i++):
  if(!$dn=$_POST["dn_$i"]) break;
  if(!$_POST["u_$i"] or !$rep=$_POST["rep_$i"]) continue;
  $dn=base64_decode($dn);
  $New=preg_split('/\\s+|\\./', $rep, 4);
  $xin='';
  if($New[1] or $New[2])$xin=$New[1]{0}.'.';
  if($New[2]) $xin.=$New[2]{0}.'.';
  $New[3]=strtoupper($xin);
  $Old=getEntry($dn, Array('info', 'description', 'displayName'));
  if(!$Old['displayname'][0]) $X['displayName']=$New[0].' '.$New[3];
  foreach(Array('info', 'description') as $k)
   if(false!==($pos=strpos($oldVal=utf2str($Old[$k][0]), $rep)))
    $X[$k]=trim(substr($oldVal, 0, $pos)).substr($oldVal, $pos+strlen($rep));
  $ii=0;
  foreach(Array('sn', 'givenName', 'middleName', 'initials') as $k)
    $X[$k]=$New[$ii++];
  foreach($X as $k=>$v)
   $X[$k]=utf8(trim($v));
  ldapModify($dn, $X);
 endfor;
 Header('Location: ./');
 exit;
endif;

uxmHeader('Миграция ФИО');

?>
<H1>Миграция ФИО</H1>
<Form Action='./' Method='POST'>
<Table Border CellSpacing='0' CellPadding='0'>
<?
LoadLib('/forms');
$q=ldap_search($CFG->h, $CFG->Base, 'objectClass=User', 
    Array('cn', 'description', 'info', 'sAMAccountName', 'sn', 'givenName', 'middleName', 'initials'));

$ux=ldap_get_entries($CFG->h, $q);
ldap_free_result($q);
$n=0;
for($i=$ux['count']-1; $i>=0; $i--)
{
 $u=$ux[$i];
 unset($ux[$i]);
 $re=preg_replace('/\\s.*/', '', $cn=utf2str($u['cn'][0]));
 $info=utf2str($u['info'][0]);
 $desc=utf2str($u['description'][0]);
 $re="/$re\\s+([а-яё\\.\\ ]*)/i";
 if(preg_match($re, $info, $match)) $txt=$info;
 elseif(preg_match($re, $desc, $match)) $txt=$desc;
 else continue;

 unset($Old);
 foreach(Array('sn', 'givenname', 'middlename', 'initials') as $k)
  $Old[]=utf2str($u[$k][0]);

 $id=utf2str($u['samaccountname'][0]);
 $n++;
 $New=preg_split('/\\s+|\\./', $replace=$match[0], 4);
 $replace=substr($replace, 0, strlen($replace)-strlen($New[3]));
 $xin='';
 if($New[1] or $New[2])$xin=$New[1]{0}.'.';
 if($New[2]) $xin.=$New[2]{0}.'.';
 $New[3]=strtoupper($xin);
 echo "<TR><TD><Input Type='CheckBox' Name='u_$n'",
    " id='cb_$n' /><Label For='cb_$n'>", htmlspecialchars($id), 
    "</Label><Sup><A\nTarget='winUser' hRef='../user", hRef('u', $id, 'x', 'contact'), 
    "'>*</A></Sup></TD>\n<TD>", htmlspecialchars($replace), "</TD>\n";
 $nn=0;
 foreach($Old as $v):
  echo "<TD><Small><Font Color='gray'>", htmlspecialchars($v), "</Font><HR />", htmlspecialchars($New[$nn++]), 
    "</Small></TD>\n";
 endforeach;

 echo "</TR><Input Type='Hidden' Name='rep_$n' Value='", htmlspecialchars($replace), "' />\n",
    "<Input Type='Hidden' Name='dn_$n' Value='", base64_encode($u['dn']), "' />\n";

}

?>
</Table>
<Input Type='Submit' Value=' Обработать отмеченные ' />
</Form>
</body></html>
