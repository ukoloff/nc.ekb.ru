<?
$CFG->params->u=trim($_REQUEST['u']);
$CFG->defaults->u=$CFG->u;
if(!$CFG->params->u or !$CFG->Who) $CFG->params->u=$CFG->u;

$CFG->tabs=Array();

/*
if($CFG->odn):	// Проверка на OU...
endif;
*/

$CFG->uSQL="'".AddSlashes($CFG->params->u)."'";

if(inTable('uxmJournal.netLog'))
 $CFG->tabs['netlogon']='Вход';

if(inTable('uTotals')):
 $CFG->tabs['inet']='Интернет';
 if('hours'==$CFG->params->x) $CFG->tabs['hours']='По часам';
endif;

if(inTable('ipUse')) 
 $CFG->tabs['where']='Откуда';

//if(inTable('uxmJournal.netLog')) 
// $CFG->tabs['netlogon']='Вход';

//if(inTable('Passwords')) 
if(inTable('uxmJournal.Password')) 
 $CFG->tabs['pass']='Пароль';

if(inGroupX('RDP', $CFG->params->u))
 $CFG->tabs['rdp']='RDP@WWW';

if(inTable('uxmJournal.OpenVPN')) 
 $CFG->tabs['ovpn']='OpenVPN';

if(!count($CFG->tabs))
 $CFG->tabs['no']='Нет информации';

if('log'==$CFG->params->x) $CFG->tabs['log']='Отчёт';

if(user2dn($CFG->params->u))
 $CFG->tabs['info']='Сведения';

//if('stas'==$CFG->u) $CFG->tabs['r']='Отладка';

$xTra=Array('sig'=>'ЭЦП', 'rdp'=>'RDP@WWW');
if($xTra[$CFG->params->x])$CFG->tabs[$CFG->params->x]=$xTra[$CFG->params->x];

function inTable($Table)
{
 global $CFG;
 $q=mysql_query("Select * From $Table Where u=".$CFG->uSQL);
 return (mysql_fetch_row($q))? 1 : 0;
}

?>
