<?
global $CFG;
if($IPs=gethostbynamel($CFG->Host=$CFG->entry->q)):
  $CFG->IP=$IPs[0];
  if($CFG->IP==$CFG->Host)$CFG->Host=gethostbyaddr($CFG->IP);
  LoadLib('snmp');
  $CFG->SNMP=snmpInfo($CFG->IP);
  $CFG->MAC=ARP($CFG->IP);
endif;
?>
<Table><TR vAlign='_top'><TD>
<Table Border CellSpacing='0'>
<? foreach(Array('Host', 'IP', 'MAC') as $k): ?>
<TR><TH Align='Right'><?=$k?></TH><TD><?=htmlspecialchars($CFG->$k)?><BR /></TD>
<? endforeach; 
if($CFG->SNMP) foreach($CFG->SNMP as $k=>$v): ?>
<TR><TH Align='Left'>SNMP::<?=$k?></TH><TD><?=htmlspecialchars($v)?><BR /></TD>
<? endforeach; ?>
</Table></TD>
<?
$q=mysql_query("Select u, Max(Time), COunt(*) From uxmJournal.netLog Where IP='".AddSlashes($CFG->IP).
    "' And Time>SubDate(Now(), Interval 3 Month) Group By u Order By 2 Desc Limit 5");
if(mysql_num_rows($q)>0):
?>
<TD>
Вход (Logon)
<Table Border CellSpacing='0'>
<TR Class='tHeader'><TH>User</TH><TH>Дата</TH><TH>*</TH></TR>
<?
while($r=mysql_fetch_row($q)):
  echo "<TR><TD>", $r[0], "<BR /></TD><TD>", $r[1], "</TD><TD>", $r[2], "</TD></TR>";
endwhile;
?>
</Table></TD>
<?endif;?>

</TR></Table>


