<?
require('../../../lib/uxm.php');
LoadLib('/tabs');

$CFG->params->in=trim($_REQUEST['in']);

if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'Новый');
else:
 $CFG->tabs=Array('list'=>'Состав', 'search'=>'Поиск', 'data'=>"Данные");
 $z=new ufn($CFG->params->in);
 $z=$z->dn();
 if($z->Canonic())
   $CFG->cdn=$z;
 else
   $CFG->tabs=Array('no'=>'Ошибка');
endif;

tabsBeforeBody();

$title='Список '.$CFG->Sendmail->Map;
if($CFG->cdn) $title.='::'.$CFG->params->in;
uxmHeader($title." [".tabName()."]");
?>
<H1>Список</H1>
<?
tabsHeader();
$in=''; $link='.';
if('/'==$CFG->params->in{0}):
 $in='/';
 $link=$CFG->Sendmail->Domain;
endif;
?>
<Div Class='ufn'><A hRef='./<?= hRef('in', $in) ?>'><?= htmlspecialchars($link)?>
</A><?
 foreach(explode('/', $CFG->params->in) as $x):
  if(!$x) continue;
  if($in and '/'!=$in)$in.='/';
  $in.=$x;
  echo "/<A hRef='", hRef('in', $in), "'>", htmlspecialchars($x), "</A>";
 endforeach;
?>
</Div>
<?
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
tabsContent();
tabsFooter();
?>
</body></html>
