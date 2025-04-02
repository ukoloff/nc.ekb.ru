<?
global $CFG;

if('*'==$_GET['port']) LoadLib('csv');

LoadLib('/sort');
LoadLib('/pages');
LoadLib('info');
$CFG->sort=Array(
    'm'=>Array('field'=>'M', 'name'=>'MAC', title=>'MAC-адрес'),
    'i'=>Array('field'=>'I', 'name'=>'IP', title=>'IP-адрес'),
);
$CFG->defaults->sort='m';

$CFG->params->n=0+$_GET['n'];
$CFG->params->port=0+$_GET['port'];

uxmHeader('Порт '.$CFG->params->port);
?>
<H1>Порт <?=$CFG->params->port?></H1>
<?
$s=$CFG->params->port;
unset($CFG->params->port);
SwitchSelector();
$CFG->params->port=$s;

$s=sqlite3_query($CFG->db, <<<SQL
Select Count(*)
From Comm Inner Join MACs On Comm.Mac=MACs.No
    Left Join ARP On Comm.Mac=ARP.Mac
    Left Join IPs On ARP.IP=IPs.No
Where Comm.Sw={$CFG->params->n} And Comm.Port={$CFG->params->port}
SQL
);
$r=sqlite3_fetch($s);
sqlite3_query_close($s);
$Start=pageStart($r[0]);
pageNavigator();
?>
<Table><TR vAlign='top'><TD>
<?
$z=LoadInfo($CFG->params->n);
PutTable($z);
?>
</TD><TD>
<?
$s=sqlite3_query($CFG->db, <<<SQL
Select MACs.Mac As M, IPs.IP As I
From Comm Inner Join MACs On Comm.Mac=MACs.No
    Left Join ARP On Comm.Mac=ARP.Mac
    Left Join IPs On ARP.IP=IPs.No
Where Comm.Sw={$CFG->params->n} And Comm.Port={$CFG->params->port}
SQL
.sqlOrderBy()." Limit {$CFG->params->pagesize} Offset $Start");
SortedHeader('mi');
while($r=sqlite3_fetch($s)):
  echo "<TR><TD Align='Right'>", htmlspecialchars($r[0]), "<BR /></TD><TD>",
    htmlspecialchars($r[1]), "<BR /></TD></TR>\n";
endwhile;
sqlite3_query_close($s);
SortedFooter();
?>
</TD></TR></Table>
<?
pageNavigator();
?>
