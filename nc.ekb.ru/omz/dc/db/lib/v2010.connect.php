<?
//ini_set('display_errors', true);
//ini_set('log_errors', false);

if(!function_exists('mssql_pconnect')) dl('mssql.so');

require_once('/etc/nc.ekb.ru/passwd/voxr2011.php');
$CFG->sql = @mssql_connect($voxrHost, $voxrUser, $voxrPass);
@mssql_select_db($voxrDB);
@mssql_query('Set TextSize 200000');

if($CFG->sql) return;

echo "<H2 Class='Error'>Проблема соединения с БД :-(</H2>";
exit;
?>
