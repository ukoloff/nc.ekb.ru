<Script><!--
function defName()
{
 f=document.forms[0];
 f.cn.focus();
 if(f.cn.value && f.cn.value!=f.sAMAccountName.value)
  if(!confirm('�������� ���� "��������"?')) return;
 f.cn.value=f.sAMAccountName.value;
}

function Valid()
{
 f=document.forms[0];
 x=f.sAMAccountName;
 if(!x.value) { alert('������� ��� ������!'); x.focus(); return false;}
 x=f.cn;
 if(!x.value) { alert('������� �������� ������!'); x.focus(); return false; }
 return true;
}
//--></Script>
<Form Action='./' Method='POST' onSubmit='return Valid()'>
<Table><TR vAlign='Top'><TD NoWrap>
<?
LoadLib('/forms');
Input('sAMAccountName', '������'); 
echo "</TD><TD>";
$CFG->defaults->Input->W=50;
Input('description', '��������');
echo "</TD></TR></Table>";
#if(!$CFG->gdn):
  echo "<Table><TR vAlign='Top'><TD>";
  Select('type', Array('s'=>'Security', 'd'=>'Distribution'), '���');
  echo "</TD><TD>";
  Select('scope', Array('g'=>'����������', 'd'=>'�����', 'u'=>'�������������'), 'Scope');
  echo "</TD></TR></Table>\n";
#endif;
echo "<Small>������������� <A hRef=# onClick='defName(); return false;'>���������� ��������</A>
����� ��, ��� ��� ������</Small>
<Table><TR vAlign='Top'><TD>";
$CFG->defaults->Input->W=45;
Input('ou', '�������������'); 
unset($CFG->params->ou);
echo "</TD><TD NoWrap>\n";
$CFG->defaults->Input->W=30;
Input('cn', '��������');
echo "</TD></TR>
<TR><TD>";
TextArea('info', '�������');
echo "</TD><TD Align='Right' vAlign='bottom'>";
if(!$CFG->gdn) unset($CFG->params->g);
hiddenInputs();
Submit();
?>
</TD></TR></Table>
<?
if($CFG->gdn)
  echo "<Small>&raquo; ������ scope �������� �������� �� ������, �� ��� ������� ����� \"�������������\" �� ����������</Small>";
?>