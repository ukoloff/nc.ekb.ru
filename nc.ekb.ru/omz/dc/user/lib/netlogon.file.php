<?
global $CFG;
if($CFG->Bottom):
 if(!isset($_REQUEST['mode']))
    $CFG->Bottom->isBinary=($CFG->Bottom->Size>10000 or !preg_match('/\.(cmd|bat|txt)$/i', $CFG->Bottom->Name));
?>
<Script Src='netlogon.js'></Script>
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
<Select onChange="addLine(this)">
<Option Value="" />�������� � ������...
<Option Value="^@Call %0\..\..\..\Group\All.bat" />����������� ������
<Option Value="@Call %Scripts%\NW\tovv.bat" />����� tovv
<Option Value="@%Scripts%\Bin\iPFX.exe" />��������� ���
</Select>
</Small>
</TD><TD>
<Input Type='Submit' Value='���������' />
</TD></TR></Table>
<?
endif;
?>
