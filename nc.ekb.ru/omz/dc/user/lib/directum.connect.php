<?
setlocale(LC_ALL, "ru_RU.cp1251");

if(!function_exists('mssql_pconnect')) dl('mssql.so');

$Cred->u='www'; $Cred->p='odteyVx25hdkUcG';
if(inGroupX('#modifyDIT')) { $Cred->u=$CFG->AD->Domain."\\".$CFG->u; $Cred->p=$_SERVER['PHP_AUTH_PW']; }
$CFG->Directum->h=@mssql_pconnect('directum', $Cred->u, $Cred->p);

function mssql_escape($S)
{
 return isset($S)? "'".strtr($S, "'", "''")."'" : "NULL";
}

?>
