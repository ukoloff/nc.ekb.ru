<Form Action='./' Method='POST'>
<?
LoadLib('/forms');
if($CFG->udn):
 Input('scriptPath', '������ ����������� [���������� <A hRef="#" onClick="stdLogin(); return false;">�����������</A>]');
?>
<BR />
<Script><!--
function stdLogin()
{
 var f=document.forms[0];
 f.scriptPath.value='uxmlogin.exe';
 f.scriptPath.focus();
}
//--></Script>
<?
endif;
$CFG->defaults->Input->maxWidth=1;
$CFG->defaults->Input->H=10;
TextArea('script', '��������� �����������');
BR();
hiddenInputs();
Submit();
?>
</Form>
<Script><!--
document.forms[0].script.focus();
--></Script>
<Small>
��������� ����������� ����������� (��� ������� ������������) � ��������� �������:
<UL>
<LI>�������� �������������, ������� �� ����� Active Directory
<LI>�������� ���� �����, ���� (����� ��� ��������) ������� ������������, �� �������: ���� ������ A �������� 
������ B, �� ��������� A ����������� ������ ��������� B
<LI>������ �������� ������������
</UL></Small>
<?
if($CFG->udn)
  echo "&raquo;��. �����: ������ (��������������) <A hRef='../script/", hRef('x', null), 
    "' Target='loginScript'>Login Script</A>";
?>
