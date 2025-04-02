<?
LoadLib('/forms');

$e=getEntry(user2dn($CFG->u), 'displayName cn');
if(!$x=$e['displayname'][0])$x=$e['cn'][0];
$CFG->entry->fromU=$CFG->u;
$CFG->entry->fromName=utf2str($x);
$e=getEntry($udn=user2dn($CFG->params->u), 'cn displayName MSSfu30NisDomain');
$noMail=!$e['mssfu30nisdomain'][0];
$CFG->entry->toName=utf2str($e['cn'][0]);
if(!$CFG->entry->Hello=utf2str($e['displayname'][0]))$CFG->entry->Hello=$CFG->entry->toName;
$CFG->entry->Hello='Здравствуйте, '.$CFG->entry->Hello.'!';
$CFG->entry->subject='Сообщение';
$CFG->entry->Bye="С уважением,";
$CFG->defaults->Input->BR='';

$Froms[$CFG->entry->fromU]=$CFG->entry->fromName;
$Froms+=Array(
    'root'=>'Системный администратор', 
    'postmaster'=>'Администратор почты',
//    'webmaster'=>'Вебмастер',
    '911'=>'Сервисная служба',
);

function readSubjects()
{
 global $CFG;
 $tr=Array('$from'=>$CFG->u, '$to'=>$CFG->params->u);
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
 echo "<Div Class='Error'>Почтовый ящик этого пользователя закрыт</Div>";
?>
<Form Action='./' Method='POST'>
<Table Width='100%'>
<TR><TD Align='Right'>От:</TD>
<TD><? $CFG->defaults->Input->W=31; Input('fromName', ''); ?>
&lt;<? $CFG->defaults->Input->W=8; Input('fromU', ''); ?>@ekb.ru&gt;</TD>
<TD Align='Right'><? 
$CFG->defaults->Input->extraAttr=' onChange="changeFrom(this)" ';
Select('', $Froms); 
?>
</TD></TR>
<TR><TD Align='Right'>Кому:</TD>
<TD><? $CFG->defaults->Input->W=31; Input('toName', ''); ?>
&lt;<?=htmlspecialchars($CFG->params->u)?>@ekb.ru&gt;</TD></TR>
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
$CFG->defaults->Input->BR='';
Input('Hello', 'Обращение');
$CFG->defaults->Input->H=10;
TextArea('body', 'Текст письма');
$CFG->defaults->Input->H=2;
TextArea('Bye', 'Подпись');
hiddenInputs();
?>
<BR />
<Input Type='Submit' Value=' Послать письмо ' />
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
 Selects[0].value=z.from;
 changeFrom(Selects[0]);
}

<?
$subject=trim($_REQUEST['subject']);
if($subject and $Subjects[$subject])
  echo "Selects[1].value='", $subject, "'; changeSubject(Selects[1]);\n";
?>
//--></Script>