<?
require('../../../../lib/uxm.php');

$CFG->params->ip=preg_replace('/[^\d\.]/', '', $_REQUEST['ip']);

if(!function_exists('sqlite3_open')) dl('sqlite3.so');
$CFG->db=sqlite3_open('../data/netlogon.db');

if('POST'==$_SERVER['REQUEST_METHOD'] and inGroupX('Domain Admins')):
 $CFG->entry->notes=trim($_REQUEST['notes']);
 if(sqlite3_exec($CFG->db, "Insert Or Replace Into ipComment(ip, Note)
    Values('{$CFG->params->ip}', '".strtr($CFG->entry->notes, array("'"=>"''"))."')")):
  Header("Location: ./".hRef());
 else:
  $CFG->Error=sqlite3_error($CFG->db);
 endif;
else:
 $q=sqlite3_query($CFG->db, "Select Note From ipComment Where ip='{$CFG->params->ip}'");
 $r=sqlite3_fetch($q);
 sqlite3_query_close($q);
 $CFG->entry->notes=$r[0];
endif;

uxmHeader('Хост');
?>
<H1>Хост</H1>
<? if($CFG->Error) echo "<Div Class='Error'>Ошибка: ", htmlspecialchars($CFG->Error), "</Div>"; ?>
<Form Action='./' Method='POST'>
<Table Border CellSpacing='0'>
<TR><TH Align='Right'>IP</TH><TD><?=htmlspecialchars($CFG->params->ip)?><BR /></TD></TR>
<TR><TH Align='Right'>MAC</TH><TD>
<?
$q=mysql_query("Select MAC From ip2mac Where ip='{$CFG->params->ip}' And Month=Date_Format(Now(), '%Y%m')");
while($r=mysql_fetch_array($q))
 echo "<A hRef='/stat/mac/", htmlspecialchars(hRef('mac', $r[0])), "' Target='_blank'>", $r[0], "</A>\n";
?>
<BR /></TD></TR>
<TR><TH Align='Right'>Хост</TH><TD>
<?
$q=mysql_query("Select host From ip2host Where ip='{$CFG->params->ip}' And Month=Date_Format(Now(), '%Y%m')");
while($r=mysql_fetch_array($q))
 echo preg_replace('/\.uxm$/', '', $r[0]), "\n";
?>
<BR /></TD></TR>


<TR><TH Align='Right'>Заметки</TH><TD>
<?
LoadLib('/forms');
$CFG->defaults->Input->BR='';
Input('notes', '');
HiddenInputs();
?>
</Table>
<Input Type='Submit' Value=' Сохранить заметки ' <? if(!inGroupX('Domain Admins')) echo "Disabled"?> />
</Form>
</body></html>
