<?
global $CFG;

$CFG->omz=getMigUser();
if(!$CFG->omz) $CFG->omz=$CFG->params->u;

function getMigUser()
{
 global $CFG;
 if(!$CFG->params->u) return;
 if(!function_exists('mssql_pconnect')) dl('mssql.so');
 $CFG->hMig=@mssql_pconnect('q5', "LAN\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
 if(!$CFG->hMig) return $CFG->params->u;
 mssql_select_db('OMZ');
 $q=mssql_query("Select omz From Impostors Where uxm='".strtr($CFG->params->u, array("'"=>"''"))."'");
 if(!$q) return;
 $r=mssql_fetch_array($q);
 if(!$r) return;
 return $r[0];
}


function migrationInfo()
{
 global $CFG;
 if(!$CFG->omz) return;
 echo "<Div Style='border: 1px solid black; border-top: none; background: silver;'>&raquo;\nМиграция в OMZGLOBAL\\<A hRef='/omz/dc/user/", hRef('u', $CFG->omz),"' Target='_uxm'>", 
    htmlspecialchars($CFG->omz), "</A></Div>\n";
}
?>
