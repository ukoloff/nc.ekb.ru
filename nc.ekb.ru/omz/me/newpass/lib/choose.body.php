<Script><!--
setTimeout(function()
{
 var x=document.forms[0].set;
 x.checked=(window.opener && window.opener.onSetPass)?1:0;
 x.disabled=!x.checked;
}, 0);
//--></Script>
����� ���� ������ ��������������� �������. �������� ���, ������� ��� ����� ����� ��������� ��� ������ ��� �������� :-)
<P />
<Table><TR vAlign='top'><TD NoWrap RowSpan='2'>
<FieldSet><Legend>������</Legend>
<?
global $CFG;
LoadLib('/forms');

if('random'==$_SESSION['type']) LoadLib('random.pass');
else LoadLib('word.pass');

$XXX=1;
for($i=16; $i>0; $i--):
 $p=newPass();
 $p64=base64_encode($p);
 if($XXX)$CFG->entry->p=$p64;
 $XXX=0;
 RadioButton('p', $p64, htmlspecialchars(preg_replace('/^\S*\s+/', '', $p)));
 echo "<BR />\n";
endfor;
echo "</FieldSet></TD><TD><FieldSet><Legend>�������������</Legend>\n";
CheckBox('set', "������� ������ � ���� ����� ������");

?>
<Div Class='Comment'>
��������� ���� ������ ����� �� ��������� ���� ������������� �������� � ���� ����� ������ ������, ���� ���� ������ �������.
��� �� ����� ������� �������� ��������� ������ � ��������� ��� � ������� �����.
</Div></FieldSet>
</TD></TR>
<TR><TD vAlign='bottom' Align='Center'>
���� �� ���� �� ������������ ������� ��� �� �������� - ������� �� ������ �������� ������
<A hRef='#' onClick='location.reload(); return false;'>��������</A>.
</TD></TR></Table>
