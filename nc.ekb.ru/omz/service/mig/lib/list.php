<?
LoadLib('/sort');
LoadLib('/pages');

$CFG->defaults->sort='t';
$CFG->defaults->pagesize=30;

foreach(Array('No'=>'№', 'IP'=>'IP', 'Host'=>'Хост', 'Room'=>'Комната', 'u'=>'Юзверь', 'Time'=>'Время') as $k=>$v):
 $c=strtolower($k{0});
 $CFG->sort[$c]=Array('name'=>$v, 'field'=>$k);
endforeach;
$CFG->sort['t']['rev']=1;
AdjustSort();

$r=sqlite3_fetch(sqlite3_query($CFG->db, 'Select Count(*) From Mig'));
$lineNo=pageStart($r[0]);

pageNavigator();
sortedHeader('nihrut');

$q=sqlite3_query($CFG->db, "Select *, datetime(Time, 'localtime') As localTime From Mig ".sqlOrderBy()." Limit {$CFG->params->pagesize} Offset $lineNo");
while($r=sqlite3_fetch_array($q)):
  foreach($r as $k=>$v) $r[$k]=htmlspecialchars($v);
  echo "<TR><TD Align='Right'><A hRef='", hRef('i', $r['No'], 'sort'),"'>{$r['No']}</A></TD><TD>{$r['IP']}<BR /></TD><TD>{$r['Host']}<BR /></TD>",
    "<TD>{$r['Room']}<BR /></TD><TD>{$r['uD']}\\{$r['u']}", checkU($r['u']),"</TD><TD>{$r['localTime']}<BR /></TD></TR>\n";
endwhile;

sortedFooter();
pageNavigator();
?>
