<?
global $CFG;
require('../../lib/uxm.php');

LoadLib('/tabs');
LoadLib('/forms');

if($CFG->i=0+$_REQUEST['i']):
 uxmHeader('���������');
else:
 $CFG->params->q=$CFG->entry->q=trim($_REQUEST['q']);
 uxmHeader('����� �� ������� �����');
endif;

echo "<Script Src='ext.js'></Script><H1>", $CFG->title, "</H1>\n";

$CFG->tabs=Array(/*'msabacus'=>'������',*/ /*'ispro'=>'��-���',*/ 
//    'dbf'=>'������ ����', 'mdb'=>'����� ����', 'mdb.direct'=>'������ ����', 
    'v2010'=>'����', '1c'=>'1�');
$CFG->defaults->x='v2010';
#if('stas'==$CFG->u)$CFG->tabs['msabacus']='�������';
#if('stas'==$CFG->u)$CFG->tabs['1c']='1�';
tabsHeader();

LoadLib($CFG->i ? 'item' : 'list');

tabsFooter();

?>
