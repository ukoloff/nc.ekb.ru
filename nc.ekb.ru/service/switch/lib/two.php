<?
global $CFG;

LoadLib('info');

$CFG->params->n=0+$_GET['n'];
$CFG->params->m=0+$_GET['m'];

# Список портов коммутатора $a на которых виден MAC коммутатора $b
# (Предположительно длиной 0 или 1)
function portsSeen($a, $b)
{
 global $CFG;
 $s=sqlite3_query($CFG->db, <<<SQL
Select Distinct Port
From Comm
Where Sw=$a
    And Mac In(Select Mac From ARP, SwInfo Where SwInfo.No=$b And ARP.IP=SwInfo.IP)
SQL
 );
 $z=Array();
 while($r=sqlite3_fetch($s))
    $z[]=$r[0];
 sqlite3_query_close($s);
 return $z;
}

uxmHeader('Коммутация');
?>
<H1>Коммутация</H1>
<Center>
<Table Border CellSpacing='0'>
<TR Align='Right'><TH></TH>
<?
$s=sqlite3_query($CFG->db, <<<SQL
Select A.Port As PA, B.Port As PB, Count(*) As N
From Comm A, Comm B
Where A.Sw={$CFG->params->n} And B.Sw={$CFG->params->m}
    And A.Mac=B.Mac
Group By A.Port, B.Port
SQL
);

$Rows=Array();
$Cols=Array();
$Nums=Array();
while($r=sqlite3_fetch_array($s)):
 $Rows[$r['PA']]=0;
 $Cols[$r['PB']]=0;
 $Nums[$r['PA']][$r['PB']]=$r['N'];
endwhile;
sqlite3_query_close($s);
foreach(portsSeen($CFG->params->n, $CFG->params->m) as $n)
    $Rows[$n]=1;
foreach(portsSeen($CFG->params->m, $CFG->params->n) as $n)
    $Cols[$n]=1;
ksort($Rows); ksort($Cols);


foreach($Cols as $j=>$jn)
  echo "<TH Width='", floor(100/(2+count($Cols))), "%' Class='Port'><Small><A hRef='./", 
    htmlspecialchars(hRef('n', $CFG->params->m, 'port', $j, 'm')), "'>$j</A></Small></TH>";
echo "<TH></TH></TR>";

foreach($Rows as $i=>$in):
 echo "<TR Align='Right'><TH Class='Port'><Small><A hRef='./", 
    htmlspecialchars(hRef('n', $CFG->params->n, 'port', $i, 'm')), "'>$i</A></Small></TH>";
 foreach($Cols as $j=>$jn):
  echo "<TD";
  if($in<>$jn) echo " Class='ByMac'";
  echo "><Small>", $Nums[$i][$j], "</BR></Small></TD>";
 endforeach;
 echo "<TH Class='Port'><Small><A hRef='./", 
    htmlspecialchars(hRef('n', $CFG->params->n, 'port', $i, 'm')), "'>$i</A></Small></TH></TR>\n";
endforeach;

echo "<TR Align='Right'><TH></TH>";
foreach($Cols as $j=>$jn)
  echo "<TH Class='Port'><Small><A hRef='./", 
    htmlspecialchars(hRef('n', $CFG->params->m, 'port', $j, 'm')), "'>$j</A></Small></TH>";
?>
<TH></TH></TR></Table>
<Table>
<TR vAlign='top'><TD>
<?
SwitchSelector();
$z=LoadInfo($CFG->params->n);
PutTable($z);

//sqlite3_exec($CFG->db, "Create Table ZZZ(A)");
//sqlite3_exec($CFG->db, "Insert Into ZZZ(A) Values(5)");
?>
</TD><TD>
<?
SwitchSelector('m');
$z=LoadInfo($CFG->params->m);
PutTable($z);
?>
</TD></TR></Table>
</Center>
&raquo;
<A hRef='./'>Все коммутаторы</A>
