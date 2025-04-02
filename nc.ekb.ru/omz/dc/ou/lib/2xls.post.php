<?
Header('Content-Type: application/vnd.ms-excel');
Header('Content-Disposition: attachment; filename="users.xls"');

foreach(explode(' ', 'l b p') as $x)
  $CFG->entry->$x=!!trim($_POST[$x]);
if($CFG->entry->l)$CFG->entry->p=1;
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns="http://www.w3.org/TR/REC-html40">
<head>
<!--[if gte mso 9]><xml>
<x:ExcelWorkbook>
<x:ExcelWorksheets>
<x:ExcelWorksheet>
<x:Name>AD users</x:Name>
<x:WorksheetOptions>
<x:NoSummaryRowsBelowDetail/>
<x:NoSummaryColumnsRightDetail/>
</x:WorksheetOptions>
</x:ExcelWorksheet>
</x:ExcelWorksheets>
</x:ExcelWorkbook>
</xml><![endif]-->
<meta http-equiv="Content-Type" content='text/html; charset=windows-1251' />
</head><body>
<table>
<TR>
<?
foreach(explode(' ', 'Отдел № Пользователь # u Фамилия Имя Отчество Должность Почта Lync Телефон Мобильный Адрес') as $z) echo "<TH>$z</TH>";
echo "</TR>\n";
dumpOU($CFG->odn->str());
?>
</Table></body></html>
<?
exit;

function dumpOU($dn, $level=0)
{
 global $CFG;
 $ufn=new DN($dn);
 $ufn=$ufn->ufn();
 $ufn=$ufn->str();
 $e=getEntry($dn, 'l');
 if(!$CFG->entry->p)
  echo "<TR", getStyle($level), "><TD><B>$ufn</B><BR /></TD><TD><B>", utf2html($e[l][0]), "</B><BR /></TD></TR>\n";

 if(!$CFG->entry->l):
  $q=ldap_list($CFG->AD->h, $dn, 'objectCategory=organizationalUnit', Array('ou'));
  for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e)):
   $z=ldap_get_values($CFG->AD->h, $e, 'ou');
   $OU[$z[0]]=ldap_get_dn($CFG->AD->h, $e);
  endfor;
  if($OU):
   sort($OU);
   foreach($OU as $z) dumpOU($z, $level+1);
  endif;
 endif;
 $q=ldap_list($CFG->AD->h, $dn, $CFG->entry->b?'objectCategory=user':'(&(objectCategory=user)(!(UserAccountControl:1.2.840.113556.1.4.803:=2)))', Array('cn'));
 for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e)):
  $z=ldap_get_values($CFG->AD->h, $e, 'cn');
  $U[$z[0]]=ldap_get_dn($CFG->AD->h, $e);
 endfor;
 if(!$U) return;
 $Style=getStyle($level+1);
 sort($U);

 foreach($U as $z):
  $e=getEntry($z);
  $e['x-01'][0]=utf8($ufn);
  $e['x-02'][0]=!!($e[useraccountcontrol][0]&2);
  $e['x-03'][0]=preg_replace('/^sip:/', '', $e['msrtcsip-primaryuseraddress'][0]);
  echo "<TR$Style>\n";
  foreach(explode(' ', 'x-01 employeeid cn x-02 samaccountname sn givenname middlename title mail x-03 telephonenumber mobile physicaldeliveryofficename') as $q)
    echo "\t<TD>", utf2html($e[$q][0]), "<BR /></TD>\n";
  echo "</TR>\n";
 endforeach;
}

function getStyle($level)
{
 global $CFG;
 if($CFG->entry->p) return '';
 $S=" Style='mso-outline-parent:collapsed";
 if($level) $S.=";display:none;mso-outline-level:$level";
 return "$S'";
}
?>
