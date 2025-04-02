<?
$q=mysql_query("Select * From BlockedSpam Where Month='{$CFG->params->m}' Order by URL");
while($r=mysql_fetch_object($q)):
 $X[$r->URL]=$r->N;
endwhile;
echo "<Table Width='100%' Border CellSpacing='0'><TR Align='Center' Class='tHeader'>";
foreach($X as $k=>$v)
 echo "<TD>", $k=='#'? 'Эвристики' : htmlspecialchars($k), "</TD>";
echo "</TR><TR Align='Center'>";
foreach($X as $k=>$v)
 echo "<TD>", htmlspecialchars($v), "</TD>";
?>
</TR></Table>
<Div Align='Left'><Small>
&raquo; Отображается только спам, блокированный при помощи эвристик и RBL ("чёрных" списков). 
Спам, блокируемый "серыми" списками, учёту не поддаётся.
</Small></Div>

<Table Width='100%' Border CellSpacing='0' CellPadding='0'>
<TR Class='tHeader'>
<TH>День</TH><TH ColSpan='2'>Блокировано сообщений</TH></TR>
<?
$xTimeStamp=chunk_split($CFG->params->m, 4, '-').'%';
$Max=sqlGet("Select Max(N) From Spam Where At Like '$xTimeStamp'");
$q=mysql_query("Select SubString(At From 7) Day, N From Spam Where At Like '$xTimeStamp' Order By At Desc");
while($r=mysql_fetch_object($q)):
 echo "<TR Align='Right'><TD>", (int)$r->Day, "</TD><TD>", $N=(int)$r->N, "</TD><TD Width='100%' Align='Left'>";
 if($N and $Max) echo "<Table Width='", 
    (int)($N/$Max*100), "%' CellSpacing='0' CellPadding='0' Class='Bar'><TR><TD><BR /></TD></TR></Table>";
 echo "</TD></TR>\n";
endwhile;
?>
</Table>

<H3>Все данные</H3>

<?
LoadLib('summary');

unset($Min); 
$q=mysql_query("Select Month, Sum(N) N From BlockedSpam Group By Month Order By Month");
while($r=mysql_fetch_object($q)):
 $X[$Max=$r->Month]=$r->N;
 if(!$Min)$Min=$Max;
endwhile;

$i=new monthIterator($Min, $Max); 
while($i->Advance())
 if($m=$i->m() and $n=$X[$m])
   echo '<Small><A hRef="./', hRef('m', $m), '">', $n, '</A></Small>';
 else
   echo "<BR />";
?>
