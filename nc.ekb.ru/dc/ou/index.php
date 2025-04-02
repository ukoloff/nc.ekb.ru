<?
require('../../lib/uxm.php');
LoadLib('/tabs');

$CFG->params->ou=$g=trim($_REQUEST['ou']);
if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'Новое');
else:
 $CFG->tabs=Array('list'=>'Состав', 'search'=>'Поиск', data=>'Данные'/*, 'login'=>'Login'*/);
// if(!$CFG->params->ou)$CFG->tabs['nw']='Netware';
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

tabsBeforeBody();

$title='Подразделение';
if($CFG->odn):
 if($CFG->params->ou) $title.=': '.$CFG->params->ou;
 else $title='Домен';
endif;
uxmHeader($title." [".tabName()."]");
echo "<H1>", ($CFG->odn and !$CFG->params->ou)? 'Домен' : 'Подразделение', "</H1>\n";
tabsHeader();
//if($CFG->odn and $CFG->params->d) echo "<H2>Подразделение: ", htmlspecialchars($CFG->params->d), "</H2>\n";
if($CFG->odn):
 LoadLib('../ufn');
 prettyUfn($CFG->odn);
endif;
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
tabsContent();
tabsFooter();
?>
</body></html>
