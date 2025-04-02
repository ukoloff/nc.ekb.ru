<link rel="stylesheet" href="<?=$jQuery='/omz/me/jQuery'?>/css/jquery.ui.all.css">
<script src="<?=$jQuery?>/jquery-1.6.2.js"></script>
<script src="<?=$jQuery?>/jquery.ui.core.js"></script>
<script src="<?=$jQuery?>/jquery.ui.widget.js"></script>
<script src="<?=$jQuery?>/jquery.ui.datepicker.js"></script>
<script src="<?=$jQuery?>/jquery.ui.datepicker-ru.js"></script>
<Script>
$(function(){
$("Input[name=date]").datepicker(
  {changeYear: 0, changeMonth: 1, showAnim: ''});
});

function X(s)
{
 if(!s.selectedIndex) return;
 var x=s.options[s.selectedIndex].value;
 s.selectedIndex=0;
 s.form.date.value=x.replace(/#.+/, '');
 s.form.time.value=x.replace(/.*?#/, '');
}

function testSure(B)
{
 var z=B.parentNode.parentNode.getElementsByTagName('DIV');
 z[0].style.display='none';
 z[1].style.display='';
}

function notSure(B)
{
 var z=B.parentNode.parentNode.getElementsByTagName('DIV');
 z[0].style.display='';
 z[1].style.display='none';
}

function startRehash(f)
{
 var z=f.getElementsByTagName('DIV');
 z[0].style.display='none';
 z[1].style.display='none';
 z[2].style.display='';
 z[3].style.display='none';
 window.Rehashed=function(S)
 {
  findId('newPass').value=S;
  window.ticketData.pass=S;
  z[0].style.display='';
  z[2].style.display='none';
  z[3].style.display='';
 }
}

setTimeout(function()
{
 if(!window.ticketData.hash) return;
 var f=document.forms[1];
 startRehash(f);
 f.submit();
}, 100);
</Script>

<? if($CFG->entry->u) echo "Виртуальный пользователь: <b>", htmlspecialchars($CFG->entry->u), "</b>\n"; ?>

<Form Action='./' Method='POST'>
<Table><TR vAlign='top'><TD RowSpan='2' NoWrap>
<FieldSet>
<Legend><Small>Права</Small>
</Legend>
<?
LoadLib('/forms');
hiddenInputs();
CheckBox('Disable', 'Доступ закрыт');	BR();
CheckBox('int', 'В локальную сеть');	BR();
CheckBox('ext', 'В Интернет');		BR();
?>
</FieldSet>
<?
Input('maxConn', 'Одновременно сеансов');
?>
<P />
<Input Type='Submit' Value='<?=' '==$CFG->params->i? ' Создать ':' Сохранить ' ?>
' />
</TD><TD NoWrap>
<?
$CFG->defaults->Input->W=10;
Input('date', 'Истекает'); 
?>
</TD><TD>
<?
$CFG->defaults->Input->W=5;
Input('time', 'В');
unset($CFG->defaults->Input->W);
?>
</TD><TD>
<?
$d=new DateTime();
$X=Array(
''=>'Выберите...',
date('d.m.Y#H:i', $d->getTimestamp()+60*60)=>'На 1 час', 
date('d.m.Y#H:i', $d->getTimestamp()+2*60*60)=>'На 2 часа', 
date('d.m.Y#H:i', $d->getTimestamp()+4*60*60)=>'На 4 часа', 
date('d.m.Y#17:20')=>'Рабочий день',
date('d.m.Y#23:59')=>'Весь день',
date('d.m.Y#17:20', $d->getTimestamp()+(12-$d->format('N'))%7*24*60*60)=>'До конца рабочей неделя',
date('d.m.Y#23:59', $d->getTimestamp()+(7-$d->format('N'))%7*24*60*60)=>'По воскресенье',
date('d.m.Y#23:59', $d->getTimestamp()+($d->format('t')-$d->format('j'))*24*60*60)=>'До конца месяца',
date('d.m.Y#23:59', $d->getTimestamp()+(364+$d->format('L')-$d->format('z'))*24*60*60)=>'До конца года'
);
$CFG->defaults->Input->extraAttr="onChange=X(this)";
Select('', $X, 'Варианты...');
?>
</TD></TR><TR><TD ColSpan='3'>
<?
$CFG->defaults->Input->maxWidth=1;
TextArea('Notes', 'Сведения');
?>
</TD></TR></Table>
</Form>

<? if(' '!=$CFG->params->i) LoadLib('pass'); ?>

<HR />
&raquo;
Вернуться к <A hRef='./'>списку</A> билетов

<? 
if(' '==$CFG->params->i) return;
$CFG->WiFi->user=$CFG->params->i;
LoadLib('/dc/user/wifi.online');
?>

