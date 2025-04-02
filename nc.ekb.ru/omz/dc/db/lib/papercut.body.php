<link REL=STYLESHEET TYPE='text/css' HREF='/omz/stat/stat.css'>
<center>
<?
dbConnect();

$CFG->defaults->d = date("Y-m-d");
$CFG->params->d = trim($_REQUEST['d']);
$reDAY = '/^(?<Y>\d{4})-?(?<M>\d{2})-?(?<D>\d{2})?$/';
if(!preg_match($reDAY, $CFG->params->d, $ymd)
    or !checkdate((int)$ymd['M'], (int)$ymd['D'] ? (int)$ymd['D'] : 1, (int)$ymd['Y']))
 $CFG->params->d = $CFG->defaults->d;

preg_match($reDAY, $CFG->params->d, $ymd);
$d = (int)$ymd['D'];
if (!$d) $d = 1;
$m = (int)$ymd['M'];
$y = (int)$ymd['Y'];

$date = new DateTime();
$date->setDate($y, $m, $d);

//--- Months -------------------------------------------------------------------

$res = pgQuery(<<<SQL
WITH mz AS (
    SELECT
	Date_trunc('month', time) AS m,
	Count(*) AS n
    FROM
	papercut
    GROUP BY
	m
)
SELECT
    to_char(m, 'YYYYMM') AS ym,
    n
FROM
    mz
ORDER BY
    m
SQL
);
unset($X); unset($Min); unset($Max);
foreach($res->rows as $r):
 $X[$Max=$r->ym] = $r->n;
 if(!$Min) $Min = $Max;
endforeach;

if($Min):
 $saveD = $CFG->defaults->d;
 $CFG->defaults->d = substr(str_replace('-', '', $CFG->defaults->d), 0, 6);
 $CFG->params->m = substr(str_replace('-', '', $CFG->params->d), 0, 6);
 $CFG->defaults->m = $CFG->defaults->d;
 LoadLib('/stat/summary');
 $i=new monthIterator($Min, $Max); 
 while($i->Advance())
  if($mi=$i->m() and $n=$X[$mi])
   echo '<a href="./', hRef('d', $mi, 'm'), '">', $n, "</a>";
  else
   echo "<br />";
 $CFG->defaults->d = $saveD;
 unset($CFG->params->m);
 unset($CFG->defaults->m);
endif;


//--- Calendar -----------------------------------------------------------------

$res = pgQuery(<<<SQL
select
  extract(day from time) as d,
  count(*) as n
from
  papercut
where
  date_trunc('month', time) = date_trunc('month', $1::date)
group by
  d
order by
  d
SQL
, Array($date->format('Y-m-d')));
unset($X); unset($Min); unset($Max);
foreach($res->rows as $r):
 $X[$Max=$r->d] = $r->n;
 if(!$Min) $Min = $Max;
endforeach;

if (!$ymd['D']):
  $d = $Min;
  $date->setDate($y, $m, $d);
endif;

$x31 = cal_days_in_month(CAL_GREGORIAN, $m, $y);
$dt = new DateTime();
$dt->setDate($y, $m, 1);
$wd = (6+(int)$dt->format('w')) % 7;
echo "<center><table border cellspacing=0><tr>";
if ($wd > 0) echo "<td colspan='$wd'></td>";
for ($i = 1; $i <= $x31; $i++, $wd++, $dt->modify('+1 day')):
    $wd %= 7;
    if ($i > 1 && $wd == 0) echo "<tr>";
    $CLASS= $i == $d ? ' class=Select' : '';
    echo "<td align='center'$CLASS><small><b>$i</b></small><br>";
    if ($X[$i]) echo '<a href=./', hRef('d', $dt->format('Y-m-d')), '>', $X[$i], '</a>';
    else echo "-";
    echo "</td>";
    if ($wd == 6) echo "</tr>\n";
endfor;
if ($wd < 6) echo "<td colspan=", 7 - $wd , "</td></tr>\n";
echo "</table></center>";

//--- Log page -----------------------------------------------------------------

$res = pgQuery(<<<SQL
select
    time:: date:: text as d,
    time:: time:: text as t,
    *
from
    papercut
where
    date_trunc('day', time) = $1::date
order by
    time
SQL
, Array($date->format('Y-m-d')));

?>
<table border cellspacing=0 id=sheet width='100%'>
<tr class=tHeader>
<th>№</th>
<th>Дата</th>
<th>Время</th>
<th>Пользователь</th>
<th>Компьютер</th>
<th title='Количество страниц'>#</th>
<th>Копий</th>
<th>Цвет</th>
<th title='Двустороняя печать'>2/с</th>
<th>Бумага</th>
<th>Принтер</th>
</tr>
<?
$NN = 0;
foreach ($res->rows as $row):
  echo '<tr title="', utf2html($row->document), '"><td><small><tt>',
    ++$NN, ".</tt></small></td><td>",
    $row->d, "</td><td>", 
    $row->t, "</td><td>", 
    '<a href=# class=filter>=</a>',
    $row->user, " <a href=../user/", hRef('u', $row->user, 'x', null, 'd'), " target=user>&raquo;</a>", "</td><td>",
    '<a href=# class=filter>=</a>',
    $row->client, " <a href=../host/", hRef('u', $row->client . '$', 'x', null, 'd'), " target=user>&raquo;</a>", "</td><td align=right>",
    $row->pages, "</td><td align=center>",
    $row->copies, "</td><td align='center'>",
    preg_match('/^\s*(NOT\s+)?GRAYSCALE\s*$/i', $row->grayscale, $gray) ? 
	"<input type=checkbox " . (!$gray[1] ? '' : 'checked') . ">" : $row->grayscale, 
    "</td><td align='center'>",
    preg_match('/^\s*(NOT\s+)?DUPLEX\s*$/i', $row->duplex, $dplx) ? 
	"<input type=checkbox " . ($dplx[1] ? '' : 'checked') . ">" : $row->duplex, 
    "</td><td align=center>",
    $row->paper ? $row->paper : ($row->width && $row->height ? $row->width . ' x ' . $row->height : ''),
    "</td><td><small>",
    utf2html($row->printer), "</small>",
    "</td></tr>\n";
endforeach;
echo "</table>";


//--- Footer -------------------------------------------------------------------
?>
<script>
setTimeout(function() {
  document.getElementById('sheet').addEventListener('click', function(e) {
    var el = e.srcElement
    switch (el.tagName) {
      default: return;
      case 'A': 
	if (el.className != 'filter') return;
	alert('Здесь будет фильтрация списка')
      case 'INPUT':
    }
    e.preventDefault()
  });
})
</script>
<style>
a.filter {
  text-decoration: none;
}
</style>