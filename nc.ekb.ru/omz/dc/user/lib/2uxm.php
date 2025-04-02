<?
$CFG->uxm=getMigUser();
if(!$CFG->uxm) $CFG->uxm=$CFG->params->u;

function getMigUser()
{
 global $CFG;
 if(!$CFG->params->u) return;
 if(!function_exists('mssql_pconnect')) dl('mssql.so');
 $CFG->hMig=@mssql_pconnect('q5', $CFG->AD->Domain."\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
 if(!$CFG->hMig) return;
 mssql_select_db('OMZ');
 $q=mssql_query("Select uxm From Impostors Where omz='".strtr($CFG->params->u, array("'"=>"''"))."'");
 if(!$q) return;
 $r=mssql_fetch_array($q);
 if(!$r) return;
 return $r[0];
}

function migrationInfo()
{
 global $CFG;
 if(!$CFG->uxm) return;
 echo "<Div Style='border: 1px solid black; border-top: none; background: silver;'>&raquo;\nМиграция из LAN\\<A hRef='/dc/user/", 
    hRef('u', $CFG->uxm),"' Target='_omz'>", htmlspecialchars($CFG->uxm), "</A> в домене LAN</Div>\n";
}
?>
