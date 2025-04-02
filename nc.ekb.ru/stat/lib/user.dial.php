<?
LoadLib('/sort');
LoadLib('/pages');
LoadLib('summary');
$CFG->sort=Array(
    '-'=>Array('name'=>'День', 'title'=>'Число месяца'),
    'b'=>Array('field'=>'StartTime', 'name'=>'Начало', 'rev'=>1, 'title'=>'Точное время, когда сессия была установлена'),
    'l'=>Array('field'=>'Name', 'name'=>'Линия', 'title'=>'Номер телефона, который принял звонок'),
    'v'=>Array('field'=>'Speed', 'name'=>'Скорость'),
    't'=>Array('field'=>'BytesIn', 'name'=>'TX', 'title'=>'Послано килобайт'),
    'r'=>Array('field'=>'BytesOut', 'name'=>'RX', 'title'=>'Получено килобайт'),
    's'=>Array('field'=>'Seconds', 'name'=>'Время', 'title'=>'Продолжительность сессии в минутах и секундах'),
    'm'=>Array('field'=>'ue', 'name'=>"\$", 'rev'=>1, 'title'=>"Плата за время соединения\n(в рублях и копейках)"),
);
$CFG->defaults->sort='b';

$Where=sprintf("Where u=%s And StartTime Like '%04d-%02d-%%'", 
    $CFG->uSQL, substr($CFG->params->m, 0, 4), substr($CFG->params->m, 4, 2));
$Sum=sqlGet("Select count(*) n, sum(ceiling(Seconds/60)) min, sum(ue) ue From Connections $Where");
$ue=$Sum->ue?'m':'';	// Добавляем поле "Деньги"
$q=mysql_query(<<<SQL
Select Connections.*, Name
From Connections Left Join LineNames Using(nasId, Line)
$Where
SQL
.sqlOrderBy());
if($lineNo=pageStart($Sum->n))
  mysql_data_seek($q, $lineNo);
PageNavigator();
sortedHeader("-blvtrs$ue");
while($r=mysql_fetch_object($q)):
 list($d, $t)=explode(' ', $r->StartTime, 3);
 list($y, $m, $d)=explode('-', $d);
 $d=(int)$d;
 echo "<TR Align='Right'><TD>$d</TD><TD>", htmlspecialchars($t), 
    "</TD><TD>", htmlspecialchars($r->Name), "</TD><TD>", (int)$r->Speed, 
    "</TD><TD>", sprintf("%.1f", $r->BytesIn/1024),
    "</TD><TD>", sprintf("%.1f", $r->BytesOut/1024),
    "</TD><TD>";
 $t=$r->Seconds;
 $m=floor($t/60); $t=$t%60;
 if($y=floor($m/60)) $t=sprintf("%d:%02d'%02d", $y, $m%60, $t);
 elseif($m) $t=sprintf("%d'%02d", $m, $t);
 else $t="$t";
 echo $t, "''</TD>";
 if($ue) printf("<TD>%.2f</TD>", $r->ue/100);
 echo "</TR>\n";
 if(isLastLine($lineNo++)) break;
endwhile;
echo "<TR Class='tHeader' Align='Right'><TH ColSpan='6'>";
if($CFG->pages>1) echo '<A hRef="./', hRefAllPages(), '" Title="Показать всё на одной (большой) странице">';
echo "Всего";
if($CFG->pages>1) echo '</A>';
echo ":\n", $Sum->n;
echo "</TH><TH>", min2h($Sum->min);
if($Sum->ue) printf("</TH><TH>%.2f", $Sum->ue/100);
echo "</TH></TR>";
sortedFooter();
PageNavigator();

pagesStop();

echo "<H3>Все данные</H3>\n";

unset($Min); 
$q=mysql_query(<<<SQL
Select count(*) n, sum(ceiling(Seconds/60)) min, year(StartTime) y, month(StartTime) m 
From Connections
Where u={$CFG->uSQL}
Group By y,m
Order By y, m
SQL
);

while($r=mysql_fetch_object($q)):
 $X[$Max=sprintf("%04d%02d", $r->y, $r->m)]=$r;
 if(!$Min)$Min=$Max;
endwhile;

$i=new monthIterator($Min, $Max); 
while($i->Advance())
 if($m=$i->m() and $n=$X[$m])
  printf('<U>%s</U><BR /><A hRef="./%s">%d</A>', min2h($n->min), hRef('m', $m), $n->n);

?>
<P />
<Div Align='Left'>
&raquo; В каждой ячейке указаны: 
<LI>В <U>числителе</U> - суммарное время (часов:минут)
<LI>В знаменателе - количество модемных сессий
</Div>
