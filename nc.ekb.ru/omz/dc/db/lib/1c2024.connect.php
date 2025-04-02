<?
if(!function_exists('mssql_pconnect')) dl('mssql.so');

$CFG->sql=@mssql_pconnect('srvsql-1c', $CFG->AD->Domain."\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
@mssql_select_db('ZUP_20');

if(!$CFG->sql):
  echo "<H2 Class='Error'>Проблема соединения с БД :-(</H2>";
  exit;
endif;

function readCTE() {
  global $CFG;
  $f = fopen(dirname(__FILE__)."/{$CFG->params->x}.sql", 'r');
  if (!$f) return;
  $name = 0;
  while (!feof($f)):
    $s = fgets($f);
    if (preg_match('/^--\s+(\w+):\s*$/', $s, $m)): 
     $name = ucfirst(strtolower($m[1]));
     $sql = '';
     continue;
    endif;
    if (!$name) continue;
    $sql .= $s;
    $tsql = trim($sql);
    $CFG->cte->{$name}= " $name as (\n$tsql\n)\n";
  endwhile;
  fclose($f);
}

readCTE();
?>
