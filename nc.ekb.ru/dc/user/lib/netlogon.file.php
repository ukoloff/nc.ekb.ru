<?
global $CFG;
if($CFG->Bottom):
 if(!isset($_REQUEST['mode']))
    $CFG->Bottom->isBinary=($CFG->Bottom->Size>10000 or !preg_match('/\.(cmd|bat|txt)$/i', $CFG->Bottom->Name));
?>
<Script><!--
function setScript()
{
 var s=document.forms[0].scriptPath;
 s.value=<?= jsEscape($CFG->params->path)?>;
 s.focus();
}

function addKey(X)
{
 var F=document.forms[1].Bat;
 F.value+='\n\n@%Scripts%\\Bin\\secKey.exe\n';
 X.blur();
 return false;
}
//--></Script>
<Table Width='100%'><TR Align='Left'>
<TD>&raquo;
<A hRef='#' onClick='setScript(); return false;'>������������</A>
</TD>
<TD><B>������</B>: <?= $CFG->Bottom->Size ?></TD>
<TD><B>����</B>: <?= strftime('%x', $CFG->Bottom->Time)?></TD>
<TD><B>�����</B>: <?= strftime('%X', $CFG->Bottom->Time)?></TD>
</TR></Table>
<?
endif;

if($CFG->Bottom->isBinary):
?>
<Small>���� ������ ����� �� ��������, ��� �� ���������, ������� ��� ���������� ����� �� ��������.
���� �� �� �� ������ ��� �����������/��������� � ��������� ��������� - �������
<A hRef='.\<?= htmlspecialchars(hRef('mode', 'edit'))?>'>������</A>.
</Small>
<?
else:
?>
<Form Action='./' Method='Post'>
<Table><TR vAlign='top'><TD Width='100%'>
<?
if(!isset($CFG->entry->Bat))
 $CFG->entry->Bat=iconv("CP866", "CP1251//IGNORE", file_get_contents($CFG->Samba->getFile($CFG->params->path)));
$CFG->defaults->Input->maxWidth=1;
$CFG->defaults->Input->H=12;
$CFG->defaults->Input->BR='';
TextArea('Bat', '');
HiddenInputs();
?>
<Small>&raquo;
� �������� ������� ������������ DOS-��������� (CP866)
<BR />
&raquo;
�������� <A hRef='#' onClick='return addKey(this)'>��������� ���</A>
</Small>
</TD><TD>
<Input Type='Submit' Value='���������' />
</TD></TR></Table>
</Form>
<?
endif;
?>
