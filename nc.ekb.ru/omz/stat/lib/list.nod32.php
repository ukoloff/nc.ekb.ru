<?

$q=mysql_query("Select Day, Count(*) As N From uxmJournal.nodUpd Where Day Like '".
    chunk_split($CFG->params->m, 4, '-')."%' Group By Day Order By Day");
unset($X);
while($r=mysql_fetch_object($q))
  $X[preg_replace('/^.*-0*/', '', $r->Day)]=$r->N;

echo "<Table Border CellSpacing='0'><TR Align='Center'>";

for($i=1; $i<=31; $i++):
 $Z=localtime(mktime(0, 0, 0, substr($CFG->params->m, 4, 2), $i, substr($CFG->params->m, 0, 4)));
 if($Z[3]<>$i) break;		// End of month
 $wd=($Z[6]+6)%7+1;
 if(1==$i and $wd>1) echo "<TD ColSpan='".($wd-1)."'></TD>";
 if(1==$wd and $i>1) echo "</TR><TR Align='Center' vAlign='Top'>";
 echo "<TD Width='14%'><Small>$i</Small><Big><BR />", $X[$i]? $X[$i]:"&nbsp;", "</Big></TD>";
endfor;
if($wd<7) echo "<TD ColSpan='".(7-$wd)."'></TD>";
echo "</TR></Table>";

$q=mysql_query('Select Left(Day, 7) As m, Count(Distinct IP) As N From uxmJournal.nodUpd Group By m Order By m');

unset($X); unset($Min); unset($Max);
while($r=mysql_fetch_object($q)):
 $X[$Max=preg_replace('/\D/', '', $r->m)]=$r->N;
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
<Div Align='Left'>
<Small>
&raquo;
Показано количество хостов, с которых зафиксировано обновление антивирусных баз Nod32
</Div>
