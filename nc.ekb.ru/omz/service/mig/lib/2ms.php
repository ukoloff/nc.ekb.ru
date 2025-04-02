<?
die("DB mssql://Q5/OMZ moved to another location!");
if(!function_exists('mssql_pconnect')) dl('mssql.so');
$h=@mssql_pconnect('Q5', $CFG->AD->Domain."\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
mssql_select_db('OMZ');

$r=$CFG->r;
@mssql_query("Insert Into Migration(uxm, Host, fromNo) Values('{$r['u']}', '{$r['Host']}', {$r['No']})");
//echo "=$h=";

/*
$q=sqlite3_query($CFG->db, "Select No, Host From Mig");
while($z=sqlite3_fetch_array($q)):
  echo $z['Host'], '[', $z['No'], '] ';
  mssql_query("Update Migration Set fromNo={$z['No']} Where Host='{$z['Host']}'");
endwhile;
*/
?>
Запись добавлена!
