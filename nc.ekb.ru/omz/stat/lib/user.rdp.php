<Table Width='100%' Border CellSpacing='0'>
<TR Class='tHeader'>
<TH>День</TH>
<TH>Число</TH>
<TH>Начало</TH>
<TH>IP (откуда)</TH>
<TH>Сервер (куда)</TH>
<TH>Время</TH>
<TH>Получено</TH>
<TH>Послано</TH>
</TR>
<?
LoadLib('/sqlite');

$h=sqlite3_open('./service/rdp/data/data.db');

$wd=explode(' ', 'вс пн вт ср чт пт сб');
$d1=chunk_split($CFG->params->m, 4, '-').'01';
$q=sqlite3_query($h, "Select s, Log.IP, time(Log.Start, 'localtime') As dTime, ".
    "strftime('%d', Log.Start, 'localtime') As Day, strftime('%w', Log.Start, 'localtime') As wDay, iBytes, oBytes, Time ".
    "From Log Left Join Data On Log.No=logNo Where u=".sqlite3_escape($CFG->params->u).
    " And (Log.Start Between datetime('$d1', 'utc') And datetime('$d1', '+1 month', 'utc'))Order By Log.Start");
while($r=sqlite3_fetch_array($q)):
 $t=$r['Time'];
 $m=floor($t/60); $t=$t%60;
 if($y=floor($m/60)) $t=sprintf("%d:%02d'%02d", $y, $m%60, $t);
 elseif($m) $t=sprintf("%d'%02d", $m, $t);

 echo "\n<TR Align='Right'><TD>", $wd[$r['wDay']],
    "<BR /></TD><TD>", $r['Day']+0,
    "<BR /></TD><TD>", $r['dTime'],
    "<BR /></TD><TD>", $r['IP'],
    "<BR /></TD><TD>", htmlspecialchars($r['s']),
    "<BR /></TD><TD>", $t,
    "<BR /></TD><TD>", b2k($r['iBytes']),
    "<BR /></TD><TD>", b2k($r['oBytes']),
    "<BR /></TD></TR>";
endwhile;

echo "</Table>";

$q=sqlite3_query($h, "Select m, count(*) As N From (Select strftime('%Y%m', Start, 'localtime') As m From Log Where u=".
    sqlite3_escape($CFG->params->u).") Group By m Order By 1");

unset($X); unset($Min); unset($Max);
while($r=sqlite3_fetch_array($q)):
 $X[$Max=$r['m']]=$r['N'];
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

if(inGroupX('RDP')):
?>
<Div Align='Left'>
&raquo;
Собственно <A hRef='/omz/service/rdp/'>терминальный доступ</A>
</Div>
<? endif; ?>
