<Form Action='./' Method='POST'>
<Table><TR vAlign='Top'><TD NoWrap>
<?
LoadLib('/forms');
hiddenInputs();
CheckBox('disable', '������������');
BR();
?>
<Div id='Notify'>
<?
  CheckBox('notify', '���������'); 
?>
</Div>
<?
CheckBox('dontExpire', '�� ��������� ����� ������');
BR();
//CheckBox('nopass', '�� ����� ������ ������'); BR();
$email=htmlspecialchars($CFG->params->u)."@ekb.ru";
CheckBox('nis', "����������� ����� <Sup><A hRef=\"mailto:$email\" Title=\"&lt;$email&gt;\">*</A></Sup>");
BR();
foreach($CFG->rList as $k=>$v):
 CheckBox("g$k", htmlspecialchars($v)); BR();
endforeach;
?>
</TD><TD NoWrap>
<?
Input('free', '���������� ������, ��');
echo "<P />";
Input('limit', '����� �������, ��');
echo "<P />";
Submit();
?>
</TD></TR></Table>
</Form>
<HR />
<Small>
&raquo; ��� ������ ������ "�� ��������� ����� ������" ������ 42 ��� ������ ����� ������������� ������������ ;-)
<BR />
&raquo; ���� ������ "������ � �������� ������" �������, �� ��������� ������ "������ � ��������" �� ����
<BR />
&raquo; ��� ��������������� ������� - �� ������� ������ � ���� "����� �������"
</Small>
<Script><!--

if(Statistics.Smart) document.forms[0].disable.onclick=xNotify;

function xNotify()
{
 findId('Notify').style.display=document.forms[0].disable.checked? 'block' : 'none';
}
--></Script>
