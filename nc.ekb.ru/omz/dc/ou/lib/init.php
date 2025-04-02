<?
LoadLib('/tabs');

$CFG->H1=$CFG->title='Подразделение';

$CFG->params->ou=$g=trim($_REQUEST['ou']);

if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'Новое');
else:
 $CFG->tabs=Array(
    'list' => 'Состав', 
    search => 'Поиск', 
    data => 'Данные', 
    '2xls' => 'Экспорт',
    bcc => 'Рассылка',
    // login => 'Login', 
);
// if('stas'==$CFG->u) $CFG->tabs['users']='Пользователи';
 $CFG->ufn=new ufn($CFG->params->ou);
 $CFG->odn=$CFG->ufn->dn();
 if(!$CFG->odn->Canonic()):
  unset($CFG->odn);
  $CFG->tabs=Array('no'=>'Ошибка');
 else: 
  if('delete'==$CFG->params->x)
   $CFG->tabs['delete']='Удаление';
 endif;
endif;

if($CFG->odn):
 if($CFG->params->ou) $CFG->title.=': '.$CFG->params->ou;
 else $CFG->H1=$CFG->title='Уралхиммаш';
endif;
$CFG->title.=' ['.tabName().']';


tabsInit();
?>
