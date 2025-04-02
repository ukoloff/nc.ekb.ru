<Table Border Width='100%' CellSpacing='0'>
<TR><TH Align='Right'>Адрес</TH><TD Width='100%'>
<?
$e=getEntry($CFG->udn, 'mail proxyAddresses msExchWhenMailboxCreated homeMDB userAccountControl mDBOverHardQuotaLimit mDBOverQuotaLimit mDBStorageQuota');
echo utf2html($e['mail'][0]);
if(strlen($e['mail'][0])) 
    echo ' <A hRef="mailto:', 
    urlencode(utf2html($e['mail'][0])), 
    '">&raquo;</A>';
/*
echo "<BR /></TD></TR><TR><TH NoWrap Align='Right'>Канонiчное написание для ОМЗ</TH><TD>";

require_once 'transliterate.php';
$ksn=getEntry($CFG->udn, 'sn');
$ksn=$ksn['sn'][0];

if(!$ksn)$ksn=$CFG->params->u;

$kgivenName=getEntry($CFG->udn,'givenName');
$kgivenName=$kgivenName['givenname'][0];
 if(!$kgivenName)
    {
     $kn=$ksn."@omzglobal.com";
    }
    else
    {
     $kn=$kgivenName.".".$ksn."@omzglobal.com";
    }
echo transliterate(utf2html($kn));
*/

echo "<BR /></TD></TR><TR><TH NoWrap Align='Right'>Адреса доставки</TH><TD>";
$a=$e['proxyaddresses'];
for($i=0; $i<$a['count']; $i++):
  if($i) echo "<BR />";
  $m=split(':', utf2html($a[$i]), 2);
  if('SMTP'==$m[0]) echo "<b>";
  if('SMTP'!=strtoupper($m[0])) echo "<i>", $m[0], "</i>:\n";
  echo $m[1];
  if('SMTP'==$m[0]) echo "</b>";
endfor;
echo "<BR /></TD></TR><TR><TH Align='Right'>Почтовая база</TH><TD>";
$dn=new DN($e['homemdb'][0]);
$dn=$dn->Cut(); echo utf2html($dn['cn']);
echo "<BR /></TD></TR><TR><TH Align='Right'>Квоты, Мб</TH><TD>",
    $e[mdboverhardquotalimit][0]/1024, "\n", $e[mdboverquotalimit][0]/1024, "\n", $e[mdbstoragequota][0]/1024,
    "<BR /></TD></TR>";
$t=$e['msexchwhenmailboxcreated'][0];
if($t):
  setlocale(LC_ALL, "ru_RU.cp1251");
  echo "<TR><TH Align='Right'>Создан</TH><TD>", strftime("%x %X", gmt2unix($t)), "<BR /></TD></TR>";
endif;
?>
</Table>
<?
if(!$e['homemdb']['count'] and $e['useraccountcontrol'][0]&uac_ACCOUNTDISABLE) return;

LoadLib($CFG->params->x.'.form');
?>
