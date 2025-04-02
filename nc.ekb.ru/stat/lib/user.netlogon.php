<Table Border Width='100%' CellSpacing='0' CellPadding='0'>
<TR Class='tHeader'><TH>День</TH><TH>Время</TH><TH>IP</TH><TH>Компьютер</TH><TH>Версия Windows</TH>
<? if(2==$CFG->Who): ?>
<TH Title='Домен пользователя'>@</TH>
<TH Title='Административные права на локальный компьютер'>Адм</TH>
<TH Title='Хост достижим (firewall отключён)'>Ping</TH>
<? endif; ?></TR>

<?
$xTimeStamp=chunk_split($CFG->params->m, 4, '-').'%';
$q=mysql_query(<<<SQL
Select *, Date_Format(Time, '%e') As Day, Date_Format(Time, '%T') As DayTime
From uxmJournal.netLog
Where u={$CFG->uSQL} And Time Like '$xTimeStamp'
Order By Time Desc
SQL
);

while($r=mysql_fetch_object($q)):
 echo "<TR><TD Align='Right'>", $r->Day,
    "<BR /></TD><TD Align='Right'>", $r->DayTime,
    "<BR /></TD><TD>", $r->IP,
    "<BR /></TD><TD>", ($r->Domain?"<code>".strtoupper($r->Domain{0})."\\</code>":""), htmlspecialchars($r->Computer),
    "<BR /></TD><TD>", htmlspecialchars($r->winVer);
 if(2==$CFG->Who)
    echo
	"<BR /><TD Align='Center'><code>", strtoupper($r->uDom{0}), "</code>", 
	"<BR /><TD Align='Center'>", $r->Admin? '+' : (is_null($r->Admin)? '':'-'),
	"<BR /><TD Align='Center'>", $r->Ping? '+' : (is_null($r->Ping)? '':'-');
 echo "<BR /></TD></TR>";
endwhile;

?>

</Table>

<?
$q=mysql_query(<<<SQL
Select Count(*) As N, Replace(Left(`Time`, 7), '-', '') As Month
From uxmJournal.netLog
Where u={$CFG->uSQL}
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
