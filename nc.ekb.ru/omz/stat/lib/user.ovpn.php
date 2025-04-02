<Table Border CellSpacing='0' CellPadding='0' Width='100%'>
<TR Class='tHeader'><TH>Дата</TH><TH>Начало</TH><TH>IP</TH><TH>Вирт. IP</TH><TH>Время</TH><TH>Послано</TH><TH>Получено</TH></TR>
<?
setlocale(LC_ALL, "ru_RU.cp1251");

$xTimeStamp=chunk_split($CFG->params->m, 4, '-').'%';

$q=mysql_query
//print
(<<<SQL
Select Unix_TimeStamp(X.`At`) As T, X.IP, X.vpnIP, Y.Time, Y.iBytes, Y.oBytes
From uxmJournal.OpenVPN As X
    Left Join uxmJournal.OpenVPN As Y On Y.Op='-' And X.u=Y.u And X.vpnIP=Y.vpnIP And X.xStart=Y.xStart
Where X.u={$CFG->uSQL} And X.`At` Like '$xTimeStamp' And X.Op='+'
Order By X.`At` Desc
SQL
);
while($r=mysql_fetch_object($q)):
 $t=$r->Time;
 $m=floor($t/60); $t=$t%60;
 if($y=floor($m/60)) $t=sprintf("%d:%02d'%02d", $y, $m%60, $t);
 elseif($m) $t=sprintf("%d'%02d", $m, $t);
 if(!$r->Time)$t='-';

 echo "<TR Align='Right'><TD>", strftime("%x", $r->T), "</TD><TD>", strftime("%X", $r->T), 
    "</TD><TD Align='Left'>", $r->IP,
    "<BR /></TD><TD Align='Left'>", $r->vpnIP, "<BR /></TD><TD>", $t, 
    "<BR /></TD><TD>", b2k($r->iBytes), "<BR /></TD><TD>", b2k($r->oBytes), 
    "<BR /></TD></TR>\n";
endwhile;
?>
</Table>
<?
$q=mysql_query(<<<SQL
Select Count(*) As N, Replace(Left(`At`, 7), '-', '')  As Month
From uxmJournal.OpenVPN
Where u={$CFG->uSQL} And Op='+'
Group By Month
Order By Month
SQL
);

unset($X); unset($Min); unset($Max);
while($r=mysql_fetch_object($q)):
 $X[$Max=$r->Month]=$r->N;
 if(!$Min)$Min=$Max;
endwhile;

if($Min):
 echo "<H2>Все данные</H2>\n";
 LoadLib('summary');
 $i=new monthIterator($Min, $Max); 
 while($i->Advance())
  if($m=$i->m() and $n=$X[$m])
   echo '<A hRef="./', hRef('m', $m), '">', $n, "</A>";
  else
   echo "<BR />";
endif;
?>
