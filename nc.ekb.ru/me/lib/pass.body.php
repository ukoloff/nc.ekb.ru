<?
if($CFG->Auth<=0 and !$CFG->Error)
 $CFG->Error='�� �� ������ �����������';
?>
&raquo;����� �� ������ �������� ���� ������, ������������ ���:
<LI>������ ����������� �����,
<LI>������� � �������� � � <A hRef='/'>�������� ������</A>, 
<LI>����� � ����� � �� �������� ������� (dbServ, KompaServ...)
<P />
<Center>
<Form Method=POST Action='./' onSubmit='return Chk(this)'>
<?
hiddenInputs();
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
?>
<!-- <Span Class='Error'>��������, ����� ������ �������� �� ��������</Span> -->
<Span Class='Error'>��������, �� ����� �������� � ����� OMZGLOBAL ��������������� ����� ������ ���������.
<BR />��� ����� ������ ����������� � ������ ������������ (���. 78-50)</Span> 
<Table><TR vAlign=top><TD Align=Center>
<FieldSet>
<Legend>
������� ����� ������
</Legend><P />
<Input Type=Password Name=p1><P />
<Input Type=Password Name=p2><P />
<Input Type=Submit Value='�������� ������!'<? if($CFG->Auth<=0) echo " Disabled"; ?>  Disabled /><P />
</FieldSet>
</TD><TD>&nbsp;</TD>
<TD>
�������� ��������:
<Small><UL>
<LI>������ ������������ � ������ ������� �����
<LI>����������, ����� ������ ������� �� ��������� ���� � ����
<LI>������� � ����� ����� ����������� (������ ����������� � ������� �������� Shift �/��� CapsLock)
<LI>������������� ����� ������ - �� ����� 8 ��������
<LI>������� ����� <A hRef='/help/pass/' Target='winPass'>���������� ��� �� �����</A> ��������� ������� �������� ��������
</UL></Small>
</TD></TR></Table>
</Form>
</Center>

<UL>
<LI>��������� �������� ������ � ��������� ��� ����� � ������� �����
<LI>������� � ������ �� ��������� ��� ������, �� ����� ������ ���������������
�� ��� �����������, ����� ��� � �� ��� ��������, ����������� ��� ����� ������� �������
<LI>��� ������������� ����� ����������, ��� ��� ������ ���� �������� �����������,
������ ����� ������� �� ��� �������� � ��������� ������
</UL>

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
//--></Script>
