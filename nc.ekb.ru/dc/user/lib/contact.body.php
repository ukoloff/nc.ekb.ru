<Script><!--
function defNames()
{
 f=document.forms[0];
 cn=f.cn;
 cn.focus();
 s=f.sn.value;
 s2='';
 x=f.givenName.value.substring(0, 1);
 if(x)
 { 
  s2=x+'.';
  if(s) s+=' '; s+=s2; 
 }
 x=f.middleName.value.substring(0, 1);
 if(x)
 {
  s+=x+'.';
  s2+=x+'.';
 }
 if(!cn.value || (cn.value!=s && confirm('�������� �������� ���� "<?= $CFG->Fields['cn']?>"?'))) 
  cn.value=s;
 cn=f.displayName;
 if(!cn.value || (cn.value!=s && confirm('�������� �������� ���� "<?= $CFG->Fields['displayName']?>"?'))) 
  cn.value=s;
// cn=f.initials;
// if(!cn.value || (cn.value!=s2 && confirm('�������� �������� ���� "<?= $CFG->Fields['initials']?>"?'))) 
//  cn.value=s2;
}

function Valid()
{
 f=document.forms[0];
 x=f.u;
 if(!x.value) { alert('������� ������� ������!'); x.focus(); return false;}
 x=f.cn;
 if(!x.value) { alert('������� ��� ������������!'); x.focus(); return false; }
// x=f.initials;
// if(x.value.length>6)
// {
//  if(confirm('"<?= $CFG->Fields['initials']?>" ������� 6 ��������. �����?')) x.value=x.value.substring(0, 6);
//  x.focus();
//  return false;
// }
 return true;
}
//--></Script>
<Form Action='./' Method='POST' onSubmit='return Valid()'>
<Input Type='Hidden' Name='imgURL' Value="<?=htmlspecialchars($CFG->entry->imgURL)?>" />
<?
LoadLib('/forms');


if(!$CFG->udn):		// ��� �� contact, ��� new
 Input('u', '������� ������ [<A hRef="../check/" Target="checkWindow">���������</A>]');
 BR();
 unset($CFG->params->u);
 echo "<Script Src='ucheck.js'></Script>";
endif;
$CFG->defaults->Input->W=45;
Input('ou', '�������������');
unset($CFG->params->ou);
$CFG->defaults->Input->W=30;
$CFG->defaults->Input->H=4;
?>
<Table Width='100%'><TR vAlign='top'>
<?
$N=0;
foreach($CFG->Fields as $k=>$v):
 switch($N++)
 {
  case 3: echo "<Small>�� ������ <A hRef=# onClick='defNames(); return false;'>����������</A><BR />
������ ���� �� �������,<BR />����� � ��������</Small>
";
  case 8: echo "</TD>\n";
  case 0: echo "<TD NoWrap>";
 }
 if('='==$v{0}):
  TextArea($k, substr($v, 1));
 else:
  Input($k, $v);
  echo "<BR />\n";
 endif;
endforeach;
hiddenInputs();
?>
<P><Center><? Submit(); ?></Center>
</TD></TR></Table>
</Form>
<HR /><Small>
&raquo;
����� �� 
<A hRef='../ext/' Target='extDB'>������� �����</A>
</Small>
