<?
LoadLib('/forms');

$nc = getEntry(user2dn('nc.ekb.ru'), 'displayName cn mail');
if(!$x=$nc['displayname'][0]) $x = $nc['cn'][0];
$CFG->entry->fromU = utf2str($nc['mail'][0]);
//$CFG->entry->fromName = utf2str($x);
$CFG->entry->fromName = 'Дирекция ИТ';

//$me = getEntry(user2dn($CFG->u), 'displayName cn mail');
//if(!$x=$me['displayname'][0]) $x = $me['cn'][0];
//$CFG->entry->fromU=utf2str($e['mail'][0]);
//$CFG->entry->fromName=utf2str($x);

$he = getEntry($udn=user2dn($CFG->params->u), 'cn displayName mail homeMDB');
$CFG->entry->toMail = utf2str($he['mail'][0]);
$noMail=!$he['homemdb'][0];
$CFG->entry->toName = utf2str($he['cn'][0]);
if(!$CFG->entry->Hello = utf2str($he['displayname'][0])) $CFG->entry->Hello = $CFG->entry->toName;
$CFG->entry->Hello='Уважаемый '.$CFG->entry->Hello.'!';
$CFG->entry->subject='Сообщение';
$CFG->entry->Bye="Дирекция ИТ\t\t\t<https://uralhimmash.ru/>";
$CFG->defaults->Input->BR='';

/*
$Froms[$CFG->entry->fromU]=$CFG->entry->fromName;
$Froms+=Array(
    'root@ekb.ru'=>'Системный администратор', 
    'postmaster@ekb.ru'=>'Администратор почты',
//    'webmaster'=>'Вебмастер',
    '911@ekb.ru'=>'Сервисная служба',
);
*/
function readSubjects()
{
 global $CFG;
 $tr=Array('$from'=>$CFG->u, '$to'=>$CFG->params->u, '$toMail'=>$CFG->entry->toMail);
 $f=fopen(dirname(__FILE__).'/mail.std', 'r');
 while(!feof($f)):
  $s=fgets($f);
  if(preg_match('/^\\[(.*)\\]\\s*$/', $s, $match)):
   $id=$match[1];
   continue;
  endif;
  if(preg_match('/^\\s*(label|from)\\s*=(.*)/', $s, $match)):
   $CFG->stdMails[$id][$match[1]]=trim($match[2]);
   continue;
  endif;
  $CFG->stdMails[$id]['body'][]=strtr(rtrim($s), $tr);
 endwhile;
 fclose($f);
}

readSubjects();
//print_r($CFG->stdMails);
foreach($CFG->stdMails as $k=>$v)
  $Subjects[$k]=$v['label'];

if($noMail)
 echo "<Div Class='Error'>Почтовый ящик этого пользователя не активирован!</Div>";
?>
<Form Action='./' Method='POST'>
<table width='100%'>
<tr><td align='Right'>От:</td>
<TD><? $CFG->defaults->Input->W=31; Input('fromName', ''); ?>
&lt;<? $CFG->defaults->Input->W=15; /*Input('fromU', '');*/ ?><?= htmlspecialchars($CFG->entry->fromU) ?>&gt;</TD>
<TD Align='Right'><!-- <? 
$CFG->defaults->Input->extraAttr=' onChange="changeFrom(this)" ';
Select('', $Froms); 
unset($CFG->defaults->Input->extraAttr);
?> -->
</TD></TR>
<TR><TD Align='Right'>Кому:</TD>
<TD><? $CFG->defaults->Input->W=31; Input('toName', ''); ?>
&lt;<?=htmlspecialchars($CFG->entry->toMail)?>&gt;</TD></TR>
<TR><TD Align='Right'>Тема:</TD>
<TD><?
$CFG->defaults->Input->W=40; 
$CFG->defaults->Input->maxWidth=true; 
Input('subject', ''); 
//$CFG->defaults->Input->maxWidth=false;
?>
</TD><TD Align='Right'><? 
$CFG->defaults->Input->extraAttr=' onChange="changeSubject(this)" ';
Select('', $Subjects); 
unset($CFG->defaults->Input->extraAttr);
?>
</TD></TR></Table>
<?
$CFG->defaults->Input->BR='<br />';
Input('Hello', 'Обращение');
$CFG->defaults->Input->H=10;
TextArea('body', 'Текст письма');
$CFG->defaults->Input->H=2;
//TextArea('Bye', 'Подпись');
hiddenInputs();
?>
<BR />
<Input Type='Submit' Value=' Послать письмо ' />
&raquo;
<small><i>Если почтовый ящик только что создан,
подождите минутку перед отправкой,
чтобы контроллеры домена обменялись обновлениями...
</i></small>
</Form>
<Script><!--
var Froms=Array();
var Subjects=Array();
<?
foreach($Froms as $k=>$v)
 echo "Froms['", AddSlashes($k), "']='", AddSlashes($v), "';\n";
foreach($CFG->stdMails as $k=>$v)
 if($k):
  echo "x=Array(); Subjects['", AddSlashes($k), "']=x;\n";
  foreach($v as $x=>$y):
   echo "x['", AddSlashes($x), "']='";
   $n=0;
   if(is_string($y))
    echo AddSlashes($y);
   else
    foreach($y as $z):
     if($n++) echo "\\n'\n\t+'";
     echo AddSlashes($z);
    endforeach;
   echo "';\n";
  endforeach;
 endif;
?>
var Selects=Array();
function findSelects()
{
 var n=0;
 var f=document.forms[0];
 for(var i=0; i<f.length; i++)
  if(f[i].type=='select-one')
   Selects[n++]=f[i]; 
}
findSelects();

function changeFrom(X)
{
 var f=document.forms[0];
 f.fromU.value=X.value;
 f.fromName.value=Froms[X.value];
}

function changeSubject(X)
{
 var z=Subjects[X.value];
 if(!z) return;
 var f=document.forms[0];
 f.subject.value=z.label;
 f.body.value=z.body;
// Selects[0].value=z.from;
// changeFrom(Selects[0]);
}

<?
$subject=trim($_REQUEST['subject']);
if($subject and $Subjects[$subject])
  echo "Selects[0].value='", $subject, "'; changeSubject(Selects[0]);\n";
?>
//--></Script>
