<?
LoadLib('/tabs');

$CFG->params->g=$g=trim($_REQUEST['g']);
if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'Новая');
else:
 $CFG->tabs=Array(
   'sum'=>'Сводка', 
   data=>'Данные', 
   'list'=>'Состав', 
   'groups'=>'Входит в', 
//   'mbox'=>'п/я',
   bcc => 'Рассылка',
 );
 if(!$g or !($CFG->gdn=group2dn($g))):
  $CFG->tabs=Array('no'=>'Ошибка');
 else: 
  if('groupz'==$CFG->params->x):
   unset($CFG->tabs['groups']);
   $CFG->tabs['groupz']='Входит в';
  endif;
  if('sub'==$CFG->params->x):
   unset($CFG->tabs['list']);
   $CFG->tabs['sub']='Подгруппы';
  endif;
  if('delete'==$CFG->params->x)
   $CFG->tabs['delete']='Удаление';
  if('unix'==$CFG->params->x)
   $CFG->tabs['unix']='Unix';
  if('xls'==$CFG->params->x)
   $CFG->tabs['xls']='XLS';
 endif;
endif;

tabsInit();

$CFG->H1=$CFG->title='Группа';
if($CFG->gdn) $CFG->title.=': '.$CFG->params->g;
$CFG->title.=" [".tabName()."]";
?>
