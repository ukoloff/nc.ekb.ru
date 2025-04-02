<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'><TH>Пользователь</TH><TH>Соединений</TH><TH>Общее время</TH></TR>
<?
$xTimeStamp=chunk_split($CFG->params->m, 4, '-').'%';

$q=mysql_query
(<<<SQL
Select X.u, Count(*) As N, Sum(Y.Time) As t
From uxmJournal.OpenVPN As X
    Left Join uxmJournal.OpenVPN As Y On Y.Op='-' And X.u=Y.u And X.vpnIP=Y.vpnIP And X.xStart=Y.xStart
Where X.`At` Like '$xTimeStamp' And X.Op='+'
Group By X.u
Order By N Desc
SQL
);
while($r=mysql_fetch_object($q)):
  $t=$r->t;
  $m=floor($t/60); $t=$t%60;
  if($y=floor($m/60)) $t=sprintf("%d:%02d'%02d", $y, $m%60, $t);
  elseif($m) $t=sprintf("%d'%02d", $m, $t);
  if(!$r->t)$t='-';

  echo '<TR Align="Right"><TD><A hRef="./', htmlspecialchars(hRef('u', $r->u, 'list')), '">', $r->u,
    "</A><BR /></TD><TD>", $r->N, "<BR /></TD><TD>$t<BR /></TD></TR>\n";
endwhile;
echo "</Table>";

$q=mysql_query(<<<SQL
Select Count(*) As N, Replace(Left(`At`, 7), '-', '')  As Month
From uxmJournal.OpenVPN
Where Op='+'
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
