<?
global $CFG;
$CFG->tabs=Array();

$CFG->uSQL="'".AddSlashes($CFG->params->u)."'";


if(inTable('uTotals')):
 $CFG->tabs['inet']='��������';
 if('hours'==$CFG->params->x) $CFG->tabs['hours']='�� �����';
endif;

if(inTable('Mails')) 
 $CFG->tabs['mail']='�����';

//if(inTable('Connections'))
// $CFG->tabs['dial']='Dialup';

if(inTable('ipUse')) 
 $CFG->tabs['where']='������';

if(inTable('uxmJournal.netLog')) 
 $CFG->tabs['netlogon']='����';

//if(inTable('Passwords')) 
if(inTable('uxmJournal.Password')) 
 $CFG->tabs['pass']='������';

if(!count($CFG->tabs))
 $CFG->tabs['no']='��� ����������';

if('log'==$CFG->params->x) $CFG->tabs['log']='�����';

if(user2dn($CFG->params->u))
 $CFG->tabs['info']='��������';

function inTable($Table)
{
 global $CFG;
 $q=mysql_query("Select * From $Table Where u=".$CFG->uSQL);
 return (mysql_fetch_row($q))? 1 : 0;
}

?>
