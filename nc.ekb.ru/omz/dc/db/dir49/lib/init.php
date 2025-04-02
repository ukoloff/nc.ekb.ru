<?
if('stas'!=$CFG->u) $CFG->AAA=2;

$CFG->title='Directum 4.9';

if(!function_exists('mssql_pconnect')) dl('mssql.so');

$CFG->Directum->h=mssql_pconnect('Dir9', $CFG->AD->Domain."\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
mssql_select_db('Directum');

function mssql_escape($S)
{
 return isset($S)? "'".strtr($S, "'", "''")."'" : "NULL";
}

?>
