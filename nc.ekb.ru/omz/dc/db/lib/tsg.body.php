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
with mz as(
    select
        date_trunc('month', start) as m,
        count(*) as n
    from
        tsg
    group by
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
  extract(day from start) as d,
  count(*) as n
from
  tsg
where
  date_trunc('month', start) = date_trunc('month', $1::date)
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
    start::date::text as d,
    start::time::text as t,
    make_interval(secs => duration)::text as len,
    pg_size_pretty(inb) as ib,
    pg_size_pretty(outb) as ob,
    *
from
    tsg
where
    date_trunc('day', start) = $1::date
order by
    start
SQL
, Array($date->format('Y-m-d')));

?>
<table id=sheet border cellspacing=0 width='100%'>
<tr class=tHeader>
<th>№</th>
<th>Дата</th>
<th>Время</th>
<th>Пользователь</th>
<th>Адрес</th>
<th>Компьютер</th>
<th>Протокол</th>
<th>Продолжительность</th>
<th>Послано</th>
<th>Получено</th>
</tr>
<?
$NN = 0;
foreach ($res->rows as $row):
  $u = preg_replace('/^.*\\\/', '', $row->user);
  $host = preg_replace('/[.]omzglobal[.]com*$/i', '', $row->host);
  echo '<tr><td><small><tt>',
    ++$NN, ".</tt></small></td><td>",
    $row->d, "</td><td>", 
    preg_replace('/[.].*/', '', $row->t), "</td><td>", 
    '<a href=# class=filter>=</a>',
    $u, " <a href=../user/", hRef('u', $u, 'x', null, 'd'), " target=user>&raquo;</a>", "</td><td>",
    utf2html($row->ip), '</td><td>',
    '<a href=# class=filter>=</a>',
    utf2str($host), " <a href=../host/", hRef('u', $host . '$', 'x', null, 'd'), " target=user>&raquo;</a>", "</td><td align=center>",
    utf2str($row->proto), "</td><td align=right>",
    utf2str($row->len), '</td><td align=right>',
    $row->ob, '</td><td align=right>',
    $row->ib,
    "</td></tr>\n";
endforeach;
echo "</table>";

//--- Footer -------------------------------------------------------------------
?>
</center>
<small>&raquo;
Отображаются только завершившиеся сессии, 
пока ещё активные не видны.
</small>
<script>
setTimeout(function() {
  document.getElementById('sheet').addEventListener('click', function(e) {
    var el = e.srcElement
    switch (el.tagName) {
      default: return;
      case 'A': 
	if (el.className != 'filter') return;
	alert('Здесь будет фильтрация списка')
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
