<?
global $CFG;

LoadLib('info');

$CFG->params->n=0+$_GET['n'];

uxmHeader('Коммутатор');
?>
<H1>Коммутатор</H1>
<Table>
<TR vAlign='top'><TD>
<?
SwitchSelector();
echo "</TD><TD>";
SwitchSelector('m');
?>
</TD></TR><TR vAlign='top'><TD>
<?
$z=LoadInfo($CFG->params->n);
PutTable($z);
?>
</TD><TD>
<Table Border CellSpacing='0'>
<TR Class='tHeader'><TH>Порт</TH><TH Title='Количество активных MAC на порту'>MAC'и</TH></TR>
<?
$s=sqlite3_query($CFG->db, "Select Port, Count(Distinct Mac) From Comm Where Sw=".$CFG->params->n." Group By Port");
while($r=sqlite3_fetch($s))
  echo "<TR Align='Right'><TH Class='Port'><A hRef='./", 
    htmlspecialchars(hRef('port', $r[0])),"'>", $r[0], "</TH><TD>", $r[1], "</TD></TR>\n";

?>
<TR Align='Right'><TH Class='Port'>*</TD><TD><A hRef='./<?=htmlspecialchars(hRef('port', '*'))?>'>CSV</A></TD></TR>
</Table>
</TD></TR></Table>
&raquo;
<A hRef='./'>Все коммутаторы</A>
