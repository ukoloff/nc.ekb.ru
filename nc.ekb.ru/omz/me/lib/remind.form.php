<? LoadLib('/forms'); ?>
<Form Method='Post' Action='./'>
<Table CellSpacing='0' CellPadding='0'><TR vAlign='top'><TD>
<? Input('date', '����'); ?>
</TD><TD>
<? Input('time', '�����'); ?>
</TD><TD>
<?
$d=new DateTime();
//$d->setTime(0, 0);
$X=Array(
''=>'��������...',
date('d.m.Y#H:i', $d->getTimestamp()+5*60)=>'����� 5 �����', 
date('d.m.Y#H:i', $d->getTimestamp()+60*60)=>'����� ���', 
date('d.m.Y#17:20')=>'� ����� �������� ���',
date('d.m.Y#23:59')=>'� ����� ���',
date('d.m.Y#08:00', $d->getTimestamp()+24*60*60)=>'������ �����',
date('d.m.Y#H:i', $d->getTimestamp()+24*60*60)=>'����� �����',
date('d.m.Y#08:00', $d->getTimestamp()+2*24*60*60)=>'����������� �����',
date('d.m.Y#17:20', $d->getTimestamp()+(12-$d->format('N'))%7*24*60*60)=>'����� ������� ������',
date('d.m.Y#23:59', $d->getTimestamp()+(7-$d->format('N'))%7*24*60*60)=>'����� ������',
date('d.m.Y#H:i', time()+7*24*60*60)=>'����� ������',
date('d.m.Y#23:59', $d->getTimestamp()+($d->format('t')-$d->format('j'))*24*60*60)=>'����� ������',
date('d.m.Y#H:i', $d->getTimestamp()+$d->format('t')*24*60*60)=>'����� �����',
date('d.m.Y#23:59', $d->getTimestamp()+(364+$d->format('L')-$d->format('z'))*24*60*60)=>'����� ����'
);
$CFG->defaults->Input->extraAttr="onChange=X(this)";
Select('', $X, '��������...');
?>
</TD></TR></Table>
<?
$CFG->defaults->Input->maxWidth=1;
Input('URL', '������ [&raquo;<A hRef="#" Target="remindHelp" onClick="return goURL(this)">�������</A>]');
BR();
TextArea('Info', '����������');
$CFG->defaults->Input->maxWidth=0;
BR();
checkBox('mail', '��������� �� �����');
BR();
checkBox('Disable', '��������� �����������');
$CFG->params->del='';
$CFG->defaults->del='.';
HiddenInputs();
?>
<P>
<? if(' '==$CFG->params->i): ?>
<Input Type='Submit' Value=' ���������� �����������! ' />
<? elseif(sqlGet("Select Count(*) From Remind Where xtime>Now() And id=".(int)$CFG->params->i)):?>
<Input Type='Submit' Value=' �������� ' />
<Input Type='Button' Value=' ������� ' onClick='doDel();' />
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
 if(!confirm('�� �������, ��� ������ ������� ��� �����������?')) return;
 document.forms[0].del.value=1;
 document.forms[0].submit();
}
//--></Script>
