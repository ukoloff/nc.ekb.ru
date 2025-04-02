<?
require('../../lib/uxm.php');
LoadLib('/tabs');

$CFG->params->g=$g=trim($_REQUEST['g']);
if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'Новая');
else:
 $CFG->tabs=Array('sum'=>'Сводка', data=>'Данные', 'list'=>'Состав', 'groups'=>'Входит в'/*, 'login'=>'Login'*/);
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
 endif;
endif;

tabsBeforeBody();

$title='Группа';
if($CFG->gdn) $title.=': '.$CFG->params->g;
uxmHeader($title." [".tabName()."]");
?>
<H1>Группа</H1>
<?
tabsHeader();
if($CFG->gdn):
 LoadLib('../ufn');
 prettyUfn($CFG->gdn, $CFG->params->g);
endif;
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
tabsContent();
tabsFooter();
?>
<Div Style='border: 1px solid black; border-top: none; background: silver;'>&raquo;
Миграция в OMZGLOBAL\<A hRef='/omz/dc/group/<?=htmlspecialchars(hRef())?>'
Target='_uxm'><?=htmlspecialchars($CFG->params->g)?></A></Div>
</body></html>
