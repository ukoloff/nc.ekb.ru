<?
if(!function_exists('mssql_pconnect')) dl('mssql.so');
$MS=@mssql_pconnect('Directum', $CFG->AD->Domain."\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
mssql_select_db('Reports');

function mssql_escape($S)
{
 return isset($S)? "'".strtr($S, array("'"=>"''"))."'" : 'NULL';
}
?>
