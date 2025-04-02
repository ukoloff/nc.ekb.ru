<? LoadLib('/forms'); ?>
<Form Method='Post' Action='./'>
<Table CellSpacing='0' CellPadding='0'><TR vAlign='top'><TD>
<? Input('date', 'Дата'); ?>
</TD><TD>
<? Input('time', 'Время'); ?>
</TD><TD>
<?
$d=new DateTime();
//$d->setTime(0, 0);
$X=Array(
''=>'Выберите...',
date('d.m.Y#H:i', $d->getTimestamp()+5*60)=>'Через 5 минут', 
date('d.m.Y#H:i', $d->getTimestamp()+60*60)=>'Через час', 
date('d.m.Y#17:20')=>'В конце рабочего дня',
date('d.m.Y#23:59')=>'В конце дня',
date('d.m.Y#08:00', $d->getTimestamp()+24*60*60)=>'Завтра утром',
date('d.m.Y#H:i', $d->getTimestamp()+24*60*60)=>'Через сутки',
date('d.m.Y#08:00', $d->getTimestamp()+2*24*60*60)=>'Послезавтра утром',
date('d.m.Y#17:20', $d->getTimestamp()+(12-$d->format('N'))%7*24*60*60)=>'Конец рабочей недели',
date('d.m.Y#23:59', $d->getTimestamp()+(7-$d->format('N'))%7*24*60*60)=>'Конец недели',
date('d.m.Y#H:i', time()+7*24*60*60)=>'Через неделю',
date('d.m.Y#23:59', $d->getTimestamp()+($d->format('t')-$d->format('j'))*24*60*60)=>'Конец месяца',
date('d.m.Y#H:i', $d->getTimestamp()+$d->format('t')*24*60*60)=>'Через месяц',
date('d.m.Y#23:59', $d->getTimestamp()+(364+$d->format('L')-$d->format('z'))*24*60*60)=>'Конец года'
);
$CFG->defaults->Input->extraAttr="onChange=X(this)";
Select('', $X, 'Варианты...');
?>
</TD></TR></Table>
<?
$CFG->defaults->Input->maxWidth=1;
Input('URL', 'Ссылка [&raquo;<A hRef="#" Target="remindHelp" onClick="return goURL(this)">Перейти</A>]');
BR();
TextArea('Info', 'Примечание');
$CFG->defaults->Input->maxWidth=0;
BR();
checkBox('mail', 'Уведомить по почте');
BR();
checkBox('Disable', 'Отключить напоминание');
$CFG->params->del='';
$CFG->defaults->del='.';
HiddenInputs();
?>
<P>
<? if(' '==$CFG->params->i): ?>
<Input Type='Submit' Value=' Установить напоминание! ' />
<? elseif(sqlGet("Select Count(*) From Remind Where xtime>Now() And id=".(int)$CFG->params->i)):?>
<Input Type='Submit' Value=' Изменить ' />
<Input Type='Button' Value=' Удалить ' onClick='doDel();' />
<? endif; ?>
</Form>
<link rel="stylesheet" href="jQuery/css/jquery.ui.all.css">
<script src="jQuery/jquery-1.6.2.js"></script>
<script src="jQuery/jquery.ui.core.js"></script>
<script src="jQuery/jquery.ui.widget.js"></script>
<script src="jQuery/jquery.ui.datepicker.js"></script>
<script src="jQuery/jquery.ui.datepicker-ru.js"></script>
<Script><!--
$("Input[name=date]").datepicker(
  {changeYear: 0, changeMonth: 1, showAnim: ''});

function X(s)
{
 if(!s.selectedIndex) return;
 var x=s.options[s.selectedIndex].value;
 s.selectedIndex=0;
 s.form.date.value=x.replace(/#.+/, '');
 s.form.time.value=x.replace(/.*?#/, '');
}

function goURL(A)
{
 var z=document.forms[0].URL.value;
 if(!z) return false;
 A.href=z;
}

function doDel()
{
 if(!confirm('Вы уверены, что хотите удалить это напоминание?')) return;
 document.forms[0].del.value=1;
 document.forms[0].submit();
}
//--></Script>
