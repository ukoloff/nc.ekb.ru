<Form Method=POST Action='./' onSubmit='return Chk(this)'>
<?
hiddenInputs();
?>
&raquo;����� <B>������������</B> �������� ������ �� ������:<BR />
<LI>� �������� � � ����������� �����
<LI>�������� ������ (�� ���� ����)
<LI>� ����� � � ����-�������� (dbServ, KompaServ...)
<P />
<Table><TR vAlign=top><TD Align=Center>
<FieldSet>
<Legend>
����� ������
</Legend><P />
<Input Type='Password' Name=p1 /><P />
<Input Type='Password' Name=p2 /><P />
<Input Type='Submit' Value='�������� ������!' /><P />
</FieldSet>
</TD><TD>&nbsp;</TD>
<TD>
�������� ��������:<BR />
<Small><UL>
<LI>������ ������������ � ������ ������� �����
<LI>����������, ����� ������ ������� �� ��������� ���� � ����
<LI>������� � ����� ����� ����������� (������ ����������� � ������� �������� Shift �/��� CapsLock)
<LI>������������� ����� ������ - �� ����� 8 ��������
<LI>������� ����� <A hRef='/help/pass/' Target='winPass'>���������� ��� �� �����</A> ��������� ������� �������� ��������
<? if(!isset($_GET['sync'])): ?>
<!--
<LI>����������� ����� <A hRef='/omz/dc/user/<?=htmlspecialchars(hRef('u', $CFG->omz, 'sync', 1))?>'
Target='_omz'>���������������� ������</A> ��� ������ ������ (LAN)
-->
<? endif; ?>
</UL></Small>
</TD></TR></Table>
</Form>
</Center>

<Script><!--
document.forms[0].p1.focus();

function Chk(f)
{
 if(f.p1.value!=f.p2.value) alert('������ �� ���������!');
 else if(f.p1.value.length<3) alert('������ ������� ��������!');
 else return true;
 f.p1.focus();
 return false;
}

function onSetPass(p)
{
 var f=document.forms[0];
 f.p1.value=p;
 f.p2.value=p;
 f.p1.select();
}

function getPass()
{
 var p=document.forms[0].p1.value;
 if(!p.length) alert('������� ������� ������ � ���� ����, � ����� ������� ������ "����������������".');
 return p;
}

<? if(isset($_GET['sync'])): ?>
function passSync()
{
 if(opener && opener.getPass) 
   onSetPass(opener.getPass());
}

passSync();
<? endif; ?>
//--></Script>
