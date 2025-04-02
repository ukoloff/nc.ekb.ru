<?
global $CFG;
$CFG->tabs=Array();

$CFG->uSQL="'".AddSlashes($CFG->params->u)."'";


if(inTable('uTotals')):
 $CFG->tabs['inet']='Интернет';
 if('hours'==$CFG->params->x) $CFG->tabs['hours']='По часам';
endif;

if(inTable('Mails')) 
 $CFG->tabs['mail']='Почта';

//if(inTable('Connections'))
// $CFG->tabs['dial']='Dialup';

if(inTable('ipUse')) 
 $CFG->tabs['where']='Откуда';

if(inTable('uxmJournal.netLog')) 
 $CFG->tabs['netlogon']='Вход';

//if(inTable('Passwords')) 
if(inTable('uxmJournal.Password')) 
 $CFG->tabs['pass']='Пароль';

if(!count($CFG->tabs))
 $CFG->tabs['no']='Нет информации';

if('log'==$CFG->params->x) $CFG->tabs['log']='Отчёт';

if(user2dn($CFG->params->u))
 $CFG->tabs['info']='Сведения';

function inTable($Table)
{
 global $CFG;
 $q=mysql_query("Select * From $Table Where u=".$CFG->uSQL);
 return (mysql_fetch_row($q))? 1 : 0;
}

?>
