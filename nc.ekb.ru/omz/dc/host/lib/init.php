<?
LoadLib('/tabs');

$CFG->params->u=$CFG->entry->u=$u=trim($_REQUEST['u']);
$CFG->tabs=Array('sum'=>'Сводка', 
    edit=>'Правка',
    ocs=> 'OCS',
    'delete'=>'Удалить', 
    'dns'=>'DNS', 
    'tree'=>'Место'
);

if(!$u or !($CFG->udn=user2dn($u))):
  $CFG->tabs=Array('no'=>'Ошибка');
elseif(!ldap_compare($CFG->AD->h, $CFG->udn, 'objectClass', 'computer')):
  Header("Location: ../user/?".$_SERVER['QUERY_STRING']);
  exit;
endif;

/*
$extraTabs=Array(
  'ocs'=>'OCS', 
);
if($extraTabs[$CFG->params->x]):
 $CFG->tabs[$CFG->params->x]=$extraTabs[$CFG->params->x];
endif;
*/

tabsInit();

$CFG->title=$CFG->H1='Компьютер';
$CFG->title.=': '.$CFG->entry->u;
