<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'><TH>Пользователь</TH><TH>Соединений</TH><TH>Общее время</TH></TR>
<?
LoadLib('/sqlite');
$h=sqlite3_open('./service/rdp/data/data.db');

$d1=chunk_split($CFG->params->m, 4, '-').'01';
$q=sqlite3_query($h, <<<SQL
Select u, Count(*) As N, Sum(Time) As t
From Log Left Join Data On Log.No=logNo
Where (Log.Start Between datetime('$d1', 'utc') And datetime('$d1', '+1 month', 'utc'))
Group By u
Order By N Desc
SQL
);

while($r=sqlite3_fetch_array($q)):
  $t=$r['t'];
  $m=floor($t/60); $t=$t%60;
  if($y=floor($m/60)) $t=sprintf("%d:%02d'%02d", $y, $m%60, $t);
  elseif($m) $t=sprintf("%d'%02d", $m, $t);
  if(!$r['t'])$t='-';

  echo '<TR Align="Right"><TD><A hRef="./', htmlspecialchars(hRef('u', $r['u'], 'list')), '">', $r['u'],
    "</A><BR /></TD><TD>", $r['N'], "<BR /></TD><TD>$t<BR /></TD></TR>\n";
endwhile;

$q=sqlite3_query($h, "Select m, count(*) As N From (Select strftime('%Y%m', Start, 'localtime') As m From Log) Group By m Order By 1");

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

?>
