<Form Action='./'>
<Table>
<TR vAlign='top'><TD>
<FieldSet><Legend>
������� ������
</Legend>
<?
HiddenInputs();
$CFG->entry->a=trim($_REQUEST['a']);
$CFG->entry->recurse=isset($_REQUEST['recurse'])? trim($_REQUEST['recurse']) : 1;
LoadLib('/forms');
CheckBox('recurse', '� � ��������������');
BR();

Select('a', Array(''=>'��������', '#'=>'���������������', '*'=>'�� � ������'), '������������');
?>
</FieldSet>
<Center>
<Input Type='Submit' Value=' ������������� ������ ' />
</Center>
</TD><TD>
<FieldSet><Legend>
���� ������
</Legend>
<?
foreach(preg_split('/[\r\n]+/', <<<TEXT
f sn ������� 
i givenName ���
o middleName ��������
fio+ ! �������+���+��������
cn+ cn ������������ (������� �.�.)
dp+ ! �������������
dn ! ������ AD-����
ufn ! ������� AD-����
i employeeID+ ��������� �����
d displayName ����� ��� (������=���)  
t title ���������
c description ��������
p telephoneNumber �������
r physicalDeliveryOfficeName �������
info info �������
s scriptpath ������ �����������
j ! �����
TEXT
)as $f):
 $f=preg_split('/\s+/', $f, 3);
 $Def='+'==substr($f[0], -1);
 if($Def) $f[0]=substr($f[0], 0, -1);
 $CFG->Fields[]=Array(c=>$f[0], Def=>$Def, AD=>$f[1], Title=>$f[2]);
endforeach;
foreach($CFG->Fields as $f):
 $c=$f['c'];
 $CFG->entry->$c=isset($_REQUEST[$c])? trim($_REQUEST[$c]) : $f['Def'];
 CheckBox($c, $f['Title']);
 BR();
endforeach;
?>
</FieldSet>

</Form>
