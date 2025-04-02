<?
global $CFG;

if(!function_exists('mssql_pconnect')) dl('mssql.so');

$CFG->sql=mssql_pconnect('Q5', 'OMZGLOBAL\\'.$CFG->u, $_SERVER['PHP_AUTH_PW']);
mssql_select_db('ZUP');

?>
