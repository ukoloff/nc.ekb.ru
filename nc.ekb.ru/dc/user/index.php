<?
require('../../lib/uxm.php');
LoadLib('/tabs');

$CFG->params->u=$CFG->entry->u=$u=trim($_REQUEST['u']);
if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'Новый');
else:
 $CFG->tabs=Array('sum'=>'Сводка', 'pass'=>'Пароль', 'contact'=>'Контакты', 
   'rights'=>'Права', 'groups'=>'Группы', 'netlogon'=>'Скрипт', 'directum'=>'2Rectum', /*'login'=>'Login', 'nw'=>'Novell' */ 'mig'=>'Мигрант');
 if(!$u or !($CFG->udn=user2dn($u))):
  $CFG->tabs=Array('no'=>'Ошибка');
 elseif(ldap_compare($CFG->h, $CFG->udn, 'objectClass', 'computer')):
  Header("Location: ../host/?".$_SERVER['QUERY_STRING']);
  exit;
 else: 
  $extraTabs=Array('ok'=>'Результат', 'groupz'=>'Группы', 'created'=>'Результат', 'unix'=>'Unix', 'mail'=>'Написать');
  if($extraTabs[$CFG->params->x]):
   unset($CFG->tabs['nw']);
   $CFG->tabs[$CFG->params->x]=$extraTabs[$CFG->params->x];
   if('groupz'==$CFG->params->x)unset($CFG->tabs['groups']);
  endif;
/*
  if('ok'==$CFG->params->x) $CFG->tabs['ok']='Результат';
  if('groupz'==$CFG->params->x):
   unset($CFG->tabs['nw']);
   unset($CFG->tabs['groups']);
   $CFG->tabs['groupz']='Группы';
  endif;
  if('created'==$CFG->params->x):
   $CFG->tabs['created']='Результат';
   unset($CFG->tabs['nw']);
  endif;
  if('unix'==$CFG->params->x):
   $CFG->tabs['unix']='Unix';
   unset($CFG->tabs['nw']);
  endif;
  if('mail'==$CFG->params->x):
   $CFG->tabs['mail']='Написать';
   unset($CFG->tabs['nw']);
  endif;
*/
 endif;
endif;

//if('POST'!=$_SERVER['REQUEST_METHOD'])LoadLib('2omz');

tabsBeforeBody();

$title='Пользователь';
if($CFG->udn) $title.=': '.$CFG->params->u;
uxmHeader($title." [".tabName()."]");
?>
<H1>Пользователь</H1>
<?
tabsHeader();
if($CFG->udn):
 LoadLib('../ufn');
 prettyUfn($CFG->udn, $CFG->params->u);
endif;
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
tabsContent();
tabsFooter();
if(function_exists('migrationInfo'))migrationInfo();
?>
</body></html>
