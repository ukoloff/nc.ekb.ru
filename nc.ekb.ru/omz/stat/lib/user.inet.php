<?
if('hours'==$CFG->params->x):
 $TH='Час';
 $Table='hTotals';
 $Column='Hour';
else:
 $TH='День';
 $Table='dTotals';
 $Column='Day';
 $Order='Desc';
endif;
?>
<Table Border Width='100%' CellSpacing='0' CellPadding='0'>
<TR Class='tHeader'><TH><?=$TH?></TH><TH ColSpan='2' Width='100%'>Трафик, Мегабайт</TH></TR>
<?
$Max=sqlGet(<<<SQL
Select Max($Table.b) 
From $Table, uTotals 
Where uTotals.u={$CFG->uSQL} And uTotals.LogId=$Table.LogId And `When`='{$CFG->params->m}'
SQL
);

$q=mysql_query(<<<SQL
Select $Column, $Table.b 
From $Table, uTotals 
Where uTotals.u={$CFG->uSQL} And uTotals.LogId=$Table.LogId And `When`='{$CFG->params->m}'
Order By $Column $Order
SQL
);

while($r=mysql_fetch_object($q)):
 printf("<TR Align='Right'><TD>%d</TD><TD>%.2f</TD><TD Width='100%%' Align='Left'>", $r->$Column, $r->b/1024/1024);
 if($r->b and $Max)
   echo "<Div Class='Bar' Style='width: ", (int)($r->b/$Max*100), "%'><BR /></Div>";
 echo "</TD></TR>\n";
endwhile;
$Total=sqlGet("Select b From uTotals Where u={$CFG->uSQL} And `When`={$CFG->params->m}");
?>
<TR Class='tHeader' Align='Right'><TH>Всего</TH><TH><?printf("%.2f", $Total/1024/1024)?></TH><TH><BR /></TH></TR>
</Table><Div Align='Left'>
<?
if('hours'!=$CFG->params->x)
  echo "&raquo; Доступна также статистика <A hRef='./", htmlspecialchars(hRef('x', 'hours')),"'>по часам</A><BR />";

if(/*'stas'==$CFG->u and*/ $CFG->params->m==$CFG->defaults->m)
  echo "&raquo; <A hRef='./", htmlspecialchars(hRef('x', 'log')), "'>Заказать</A> подробный отчёт по расходованию Интернет-трафика";
?>
</Div><H3>Все данные</H3>
<?
LoadLib('summary');

unset($Min); 
$q=mysql_query("Select `When` Month, b From uTotals Where u={$CFG->uSQL} Order By Month");
while($r=mysql_fetch_object($q)):
 $X[$Max=$r->Month]=$r->b;
 if(!$Min)$Min=$Max;
endwhile;

$i=new monthIterator($Min, $Max); 
while($i->Advance())
 if($m=$i->m() and $n=$X[$m])
   echo '<A hRef="./', hRef('m', $m), '">', b2k($n), "</A>";
 else 
   echo "<BR />";
?>
<P />
<Div Align='Left'><Small>&raquo; 1 килобайт (кб/k)=1024 байт (символов)<BR />
&raquo; 1 Мегабайт (Мб/M)=1024 килобайт (=1 048 576 байт)<BR />
&raquo; 1 Гигабайт (Гб/G)=1024 Мегабайт (=1 073 741 824 байт)
</Small></Div>
