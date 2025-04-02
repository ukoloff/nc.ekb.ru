<?
setlocale(LC_ALL, "ru_RU.cp1251");

if(!function_exists('mssql_pconnect')) dl('mssql.so');
$MS=@mssql_pconnect('Q5', $CFG->AD->Domain."\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
mssql_select_db('OMZ');

$q=mssql_query("Select * From Migration Where omz='{$CFG->params->u}'");
$r=mssql_fetch_assoc($q);

if(!$r):
  echo '<Center>Сведений о миграции не найдено</Center>';
else:
  foreach($r as $k=>$v):
    echo "<LI><B>$k</B>=", htmlspecialchars($v), "\n";
    if('uxm'==$k) echo "<A hRef='/dc/user/", htmlspecialchars(hRef('u', $v, 'x')), "' Target='_blank'>&raquo;</A>";
    if('Host'==$k) echo "<A hRef='../host/", htmlspecialchars(hRef('u', $v.'$', 'x')), "' Target='_blank'>&raquo;</A>";
    if('Date'==$k) echo "[GMT]";
  endforeach;
endif;

if($r['fromNo']):
  echo "<H3>По заявке #", $r['fromNo'], ":</H3>";
  LoadLib('/sqlite');
  $z=sqlite3_open('./service/mig/data/mig.db');
  $q=sqlite3_query($z, "Select * From Mig Where No=".$r['fromNo']);
  $r=sqlite3_fetch_array($q);
  if(!$r)
    echo "Запись не найдена!";
  else
   foreach($r as $k=>$v):
    echo "<LI><B>$k</B>=", nl2br(htmlspecialchars($v));
    if('Time'==$k) echo "[GMT]";
   endforeach;
endif;

?>
