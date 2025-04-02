<?
global $CFG;
require('../../lib/uxm.php');

LoadLib('/tabs');
LoadLib('/forms');

if($CFG->i=0+$_REQUEST['i']):
 uxmHeader('Сотрудник');
else:
 $CFG->params->q=$CFG->entry->q=trim($_REQUEST['q']);
 uxmHeader('Поиск по внешним базам');
endif;

echo "<Script Src='ext.js'></Script><H1>", $CFG->title, "</H1>\n";

$CFG->tabs=Array(/*'msabacus'=>'Абакус',*/ /*'ispro'=>'ИС-ПРО',*/ 
//    'dbf'=>'Старый ВОХР', 'mdb'=>'Новый ВОХР', 'mdb.direct'=>'Свежий ВОХР', 
    'v2010'=>'ВОХР', '1c'=>'1С');
$CFG->defaults->x='v2010';
#if('stas'==$CFG->u)$CFG->tabs['msabacus']='Сабакус';
#if('stas'==$CFG->u)$CFG->tabs['1c']='1С';
tabsHeader();

LoadLib($CFG->i ? 'item' : 'list');

tabsFooter();

?>
