<link REL=STYLESHEET TYPE='text/css' HREF='/omz/stat/stat.css'>
<?
$CFG->params->pass=1;
dbConnect();

$CFG->params->i=(int)trim($_GET['i']);

$CFG->defaults->m=date("Ym");
if(!preg_match('/^\d{6}$/', $CFG->params->m=trim($_REQUEST['m']))
    or !checkdate(substr($CFG->params->m, 4, 2), 1, substr($CFG->params->m, 0, 4)))
 $CFG->params->m=$CFG->defaults->m;

$d1=chunk_split($CFG->params->m, 4, '-').'01';


$s = $CFG->sigur->prepare(<<<SQL
select 
  L.*,
  weekday(logtime) As Day,
  ord(substr(logdata, 5, 1)) As Dir,
  D.NAME As Gate
From 
  `tc-db-log`.logs L
  Left Join devices D on D.id=devhint
Where
  EMPHINT=:id
  and logtime between :m and adddate(:m, interval 1 month)
Order By logtime
SQL
);
$s->execute(Array('id'=>$CFG->params->i, 'm'=>$d1));
?>
<center>
<table Border x-Width='100%' CellSpacing='0'><TR Class='tHeader'>
<TH>День</TH>
<TH>Дата</TH>
<TH>Время</TH>
<TH>Направление</TH>
<TH>Турникет</TH>
</TR>
<?
$wd=explode(' ', 'пн вт ср чт пт сб вс');

while($row = $s->fetch()): 
    $dt = explode(' ', $row['LOGTIME']);
    switch($z=$row['Dir']){
        case 1: $z='Выход'; break;
	case 2: $z='Вход'; break;
    }

    echo "<tr><td>", $wd[$row['Day']],
	"</td><td>", $dt[0],
	"</td><td>", $dt[1],
	"</td><td>", $z,
	"</td><td>", $row['Gate'],
	"</td></tr>";
endwhile;
?>
</table>
</center>
<?
$s = $CFG->sigur->prepare(<<<SQL
select 
  extract(year_month from logtime) As YM,
  count(*) as N
From 
  `tc-db-log`.logs L
Where
  EMPHINT=?
Group by YM
Order By 1
SQL
);
$s->execute(Array($CFG->params->i));

unset($X); unset($Min); unset($Max);
while($r=$s->fetch()):
 $X[$Max=$r['YM']]=$r['N'];
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
