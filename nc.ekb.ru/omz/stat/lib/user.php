<?
$CFG->params->u=trim($_REQUEST['u']);
$CFG->defaults->u=$CFG->u;
if(!$CFG->params->u or !$CFG->Who) $CFG->params->u=$CFG->u;

$CFG->tabs=Array();

/*
if($CFG->odn):	// �������� �� OU...
endif;
*/

$CFG->uSQL="'".AddSlashes($CFG->params->u)."'";

if(inTable('uxmJournal.netLog'))
 $CFG->tabs['netlogon']='����';

if(inTable('uTotals')):
 $CFG->tabs['inet']='��������';
 if('hours'==$CFG->params->x) $CFG->tabs['hours']='�� �����';
endif;

if(inTable('ipUse')) 
 $CFG->tabs['where']='������';

//if(inTable('uxmJournal.netLog')) 
// $CFG->tabs['netlogon']='����';

//if(inTable('Passwords')) 
if(inTable('uxmJournal.Password')) 
 $CFG->tabs['pass']='������';

if(inGroupX('RDP', $CFG->params->u))
 $CFG->tabs['rdp']='RDP@WWW';

if(inTable('uxmJournal.OpenVPN')) 
 $CFG->tabs['ovpn']='OpenVPN';

if(!count($CFG->tabs))
 $CFG->tabs['no']='��� ����������';

if('log'==$CFG->params->x) $CFG->tabs['log']='�����';

if(user2dn($CFG->params->u))
 $CFG->tabs['info']='��������';

//if('stas'==$CFG->u) $CFG->tabs['r']='�������';

$xTra=Array('sig'=>'���', 'rdp'=>'RDP@WWW');
if($xTra[$CFG->params->x])$CFG->tabs[$CFG->params->x]=$xTra[$CFG->params->x];

function inTable($Table)
{
 global $CFG;
 $q=mysql_query("Select * From $Table Where u=".$CFG->uSQL);
 return (mysql_fetch_row($q))? 1 : 0;
}

?>
