<?
if(!function_exists('mssql_pconnect')) dl('mssql.so');

//$CFG->sql=mssql_pconnect($CFG->c1->Srv?$CFG->c1->Srv:'Q6', $CFG->AD->Domain.'\\'.$CFG->u, $_SERVER['PHP_AUTH_PW']);
//mssql_select_db($CFG->c1->DB?$CFG->c1->DB:'ZUP');

$CFG->sql=mssql_pconnect('srvsql-1c', $CFG->AD->Domain.'\\'.$CFG->u, $_SERVER['PHP_AUTH_PW']);
mssql_select_db('ZUP');

?>
