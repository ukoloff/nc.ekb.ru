<?
LoadLib('/tabs');

$CFG->params->u=$CFG->entry->u=$u=trim($_REQUEST['u']);
if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'Новый');
else:
 $CFG->tabs=Array('sum'=>'Сводка', 'pass'=>'Пароль', 
    'ocs' => 'OCS',
    'contact'=>'Контакты', 'photo'=>'Фото',
    'rights'=>'Права', 'mbox'=>'п/я', lync=>'Lync', 'groups'=>'Группы', 
//	'netlogon'=>'Скрипт', 
//	wifi=>'Wi-Fi', 
    'directum'=>'2Rectum'/*, rsa=>'ЭЦП'*/ /*, 'mig'=>'Мигрант'*/);
// if('stas'!=$CFG->u)unset($CFG->tabs['lync']);
 if(!inGroupX('Редакторы пользователей') and !inGroupX('#modifyDIT')) unset($CFG->tabs[photo]);
 if(!inGroupX('#modifyDIT')) unset($CFG->tabs[wifi]);
 LoadLib('/me/pki.export');
// if('stas'==$CFG->u)$CFG->tabs['rsa']='ЭЦП';
 if(!$u or !($CFG->udn=user2dn($u))):
  $CFG->tabs=Array('no'=>'Ошибка');
 elseif(ldap_compare($CFG->AD->h, $CFG->udn, 'objectClass', 'computer')):
  Header("Location: ../host/?".$_SERVER['QUERY_STRING']);
  exit;
 else: 
  $extraTabs=Array('ok'=>'Результат', 'groupz'=>'Группы', 'created'=>'Результат', 'unix'=>'Unix', 'mail'=>'Написать',
    'json' => 'Атрибуты',
    'unlock'=>'Снять блок');
  if($extraTabs[$CFG->params->x]):
   $CFG->tabs[$CFG->params->x]=$extraTabs[$CFG->params->x];
   if('groupz'==$CFG->params->x)unset($CFG->tabs['groups']);
  endif;
 endif;
endif;

tabsInit();

$CFG->H1=$CFG->title='Пользователь';
if($CFG->udn) $CFG->title.=': '.$CFG->params->u;
$CFG->title.=" [".tabName()."]";
?>
