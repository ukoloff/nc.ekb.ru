<?
global $CFG;

if(!function_exists('mssql_pconnect')) dl('mssql.so');

$CFG->sql=mssql_pconnect('omega', 'LAN\\'.$CFG->u, $_SERVER['PHP_AUTH_PW']);
mssql_select_db('Abacus');
#$CFG->Abacus->Schema='M_DEMO_DATA2';
#$CFG->Abacus->metaSchema='M_MD';
?>
