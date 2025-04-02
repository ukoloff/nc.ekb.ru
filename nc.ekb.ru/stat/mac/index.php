<?
require('../../lib/uxm.php');
LoadLib('/forms');

$mac='';
foreach(preg_split('/[^0-9a-f]+/', strtolower(trim($_REQUEST['mac']))) as $hex):
 if(''==$hex) continue;
 if(1==strlen($hex)):
  $hex='0'.$hex;
 else:
  $hex=preg_replace('/:$/', '', chunk_split($hex, 2, ':'));
 endif;
 if($mac)$mac.=':';
 $mac.=$hex;
endforeach;

$CFG->entry->mac=$CFG->params->mac=$mac;

uxmHeader('Поиск по MAC-адресу');

function DHCP($x='')
{
 global $CFG;
 $N=0;
 $q=mysql_query("Select * From ip2mac Where MAC='".$CFG->entry->mac."' Order By Month Desc");
 while($r=mysql_fetch_object($q)):
  if(!$N++):
?>
<H2>DHCP</H2>
<Table Border CellSpacing='0'>
<TR Class='tHeader'><TH>IP</TH><TH>Хост</TH><TH>Месяц</TH></TR>
<?
  endif;
  if($x and $N>2):
    echo "<TR Align='Right' Class='tHeader'><TD Align='Center'>...</TD><TD ColSpan='2'><A hRef='", hRef('x', $x), 
	"'>Всего</A>: ", mysql_num_rows($q), "</A></TD></TR>";
    break;
  endif;
  echo "<TR Align='Right'><TD>", htmlspecialchars($r->ip), "</TD><TD>", 
    htmlspecialchars($r->Host), "</TD><TD>", 
    htmlspecialchars($r->Month), "</TD></TR>\n";
 endwhile;
 if($N) echo "</Table>\n";
}

function Netware($x='')
{
 global $CFG;
 $N=0;
 $q=mysql_query("Select * From nwusers Where MAC='".$CFG->entry->mac."' Order By Month Desc");
 while($r=mysql_fetch_object($q)):
  if(!$N++):
?>
<H2>Netware</H2>
<Table Border CellSpacing='0'>
<TR Class='tHeader'><TH>User</TH><TH>Сервер</TH><TH>Месяц</TH></TR>
<?
  endif;
  if($x and $N>2):
    echo "<TR Align='Right' Class='tHeader'><TD Align='Center'>...</TD><TD ColSpan='2'><A hRef='", hRef('x', $x), 
	"'>Всего</A>: ", mysql_num_rows($q), "</A></TD></TR>";
    break;
  endif;
  echo "<TR Align='Right'><TD>", htmlspecialchars($r->u), "</TD><TD>", 
    htmlspecialchars($r->server), "</TD><TD>", 
    htmlspecialchars($r->Month), "</TD></TR>\n";
 endwhile;
 if($N) echo "</Table>\n";
}

?>
<H1>Поиск по MAC-адресу</H1>
<Form Action='./'>
<?
Input('mac', 'MAC-адрес');
?>
<Input Type='submit' Value='Поиск!' />
</Form>
<?
if(!$mac):
?>
<Script><!--
document.forms[0].mac.focus();
//--></Script>
<?
else:
 switch(strtolower(trim($_REQUEST['x'])))
 {
  case 'dhcp': 
    DHCP();
    break;
  case 'nw':
    Netware();
    break;
  default:
    DHCP('dhcp');
//    Netware('nw');
 }
endif;
?>

</body></html>
