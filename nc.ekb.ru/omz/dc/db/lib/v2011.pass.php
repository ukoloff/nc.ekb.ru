<link REL=STYLESHEET TYPE='text/css' HREF='/omz/stat/stat.css'>
<?
$CFG->params->pass=1;
dbConnect();

$CFG->params->i=(int)trim($_GET['i']);
if($CFG->params->i<=0)$CFG->params->i=-112;
?>
<Table Border Width='100%' CellSpacing='0'><TR Class='tHeader'>
<TH>День</TH>
<TH>Дата</TH>
<TH>Время</TH>
<TH>Направление</TH>
<!--<TH>Турникет</TH>-->
</TR>
<?
$CFG->defaults->m=date("Ym");
if(!preg_match('/^\d{6}$/', $CFG->params->m=trim($_REQUEST['m']))
    or !checkdate(substr($CFG->params->m, 4, 2), 1, substr($CFG->params->m, 0, 4)))
 $CFG->params->m=$CFG->defaults->m;

$d1=chunk_split($CFG->params->m, 4, '-').'01';

$q=mssql_query(<<<SQL
Select
    CONVERT(varchar, EVENT_TIME_UTC, 20) As t,
    DatePart(dw, EVENT_TIME_UTC) as wd,
    DEVID,
    READERDESC As Dst,
    PanelID, ReaderID --, COMMADDR
From EVENTS 
    Left Join Reader On PanelID=MACHINE And ReaderID=DevID
Where EMPID={$CFG->params->i} And (EVENT_TIME_UTC Between '$d1' And dateAdd(m, 1, '$d1')) Order By 1
SQL
);

$wd=explode(' ', 'вс пн вт ср чт пт сб');
while($r=mssql_fetch_array($q)):
 echo "<TR Align='Right'><TD>", $wd[$r['wd']-1],
    "<BR /></TD><TD>", implode('</TD><TD>', explode(' ', utc2str($r['t']))),
    "<BR /></TD><TD Style='text-align: left; font-style: italic;'>", htmlspecialchars($r[Dst]),
//    "<BR /></TD><TD>", $r[PanelID], '.', $r[ReaderID], //'/', $r[COMMADDR],
    "<BR /></TD></TR>\n";
endwhile;

echo "</Table>";

$q=mssql_query(<<<SQL
Select m, Count(*) As N
    From (Select Convert(varchar(6), EVENT_TIME_UTC, 112) As m From EVENTS Where EMPID={$CFG->params->i}) As T
    Group By m Order By m
SQL
);
unset($X); unset($Min); unset($Max);
while($r=mssql_fetch_array($q)):
 $X[$Max=$r['m']]=$r['N'];
 if(!$Min)$Min=$Max;
endwhile;
if($Min):
 echo "<Center><H2>Все данные</H2>";
 LoadLib('/stat/summary');
 $i=new monthIterator($Min, $Max); 
 while($i->Advance())
  if($m=$i->m() and $n=$X[$m])
   echo '<A hRef="./', hRef('m', $m), '">', $n, "</A>";
  else
   echo "<BR />";
endif;

?>
