<Table Border CellSpacing='0' CellPadding='0' Width='100%'>
<TR Class='tHeader'><TH>Дата</TH><TH>Время</TH><TH>Кто</TH><TH>Компьютер</TH><TH>IP</TH></TR>
<?
setlocale(LC_ALL, "ru_RU.cp1251");

$xTimeStamp=chunk_split($CFG->params->m, 4, '-').'%';

$q=mysql_query(<<<SQL
Select Unix_TimeStamp(`When`) T, Who, P.IP, Host
From uxmJournal.Password As P Left Join ip2host On Month='{$CFG->params->m}' And P.IP=ip2host.ip
Where P.u={$CFG->uSQL} And P.`When` Like '$xTimeStamp'
Order By `When` Desc
SQL
);
while($r=mysql_fetch_object($q)):
 $Who=$r->Who;
 if(!$Who or $Who==$CFG->params->u) $Who='';
 echo "<TR Align='Right'><TD>", strftime("%x", $r->T), "</TD><TD>", strftime("%X", $r->T), 
    "</TD><TD Align='Left'>", $Who, 
    "<BR /></TD><TD>", preg_replace('(\\.uxm$)', '', $r->Host), "<BR /></TD><TD Align='Left'>", $r->IP, "<BR /></TD></TR>\n";
endwhile;
?>
</Table>
<Small>
На этой странице отображается история <A hRef="/me/?x=pass">изменения пароля</A> к учётной записи.
</Small>
<?
$q=mysql_query(<<<SQL
Select Count(*) As N, Replace(Left(`When`, 7), '-', '')  As Month
From uxmJournal.Password
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
