<Form Action='./' Method='Post'>
<?
//global $CFG;

LoadLib('/forms');

if(!$CFG->Directum->h)
  echo "<H2 Class='Error'>�� �� ������ ����� �� �������� ���� ����������</H2>\n";

HiddenInputs();
?>
<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'><TH>����</TH><TH>������������ Directum</TH><TH>������������ SQL</TH></TR>
<?
$N=0;
foreach($CFG->Directum->DBs As $DB):
 echo "<TR><TD>", htmlspecialchars($DB), "</TD><TD><Input Type='CheckBox' Disabled ";
 $x='User'.$N;
 if($CFG->Directum->Entry->$x) echo " Checked />\n", 
    htmlspecialchars($CFG->Directum->Entry->$x->Mode), 
    userStatus($CFG->Directum->Entry->$x->X), 
    ": ", htmlspecialchars($CFG->Directum->Entry->$x->Name);
 else echo "/>";
 echo "</TD><TD>";
 CheckBox("Role".$N, $CFG->Directum->Entry->$x->U);
 echo "</TD></TR>\n";
 $N++;
endforeach;
?>
</Table>
<Table Width='100%'><TR><TD>
<?
CheckBox("Login", '����� ����� �� ������');
echo "</TD><TD Align='Right'>";
Submit();
echo "</TD></TR></Table></Form>";

function userStatus($s)
{
 switch($s)
 {
  case '�': return '';
  case '�': return '!';	//�����
  case '�': return '#';	//��������
  case '�': return '*';	//�����������
 }
 return '?';
}

?>
<Small>
&raquo;
��� ����, ����� ������������ ��� ����� � �� Directum, ����������, ����� ����:
<UL>
<LI><s>����� ����� �� ������</s> (�� ��������� � Directum 5)
<LI>������ ������������ SQL � ���� ��
<LI>������ ������������ Directum � ���� ��
<LI>��� ����������� ������������ - Windows (W)
<LI>������������ �� ������������ (#)
</UL>
&raquo;
������������ Directum ����� �����������/��������� ������ � ����� Directum

<HR />
<h2>�����������</h2>
<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'><TH>����</TH><TH>�</TH><TH>CN</TH><TH>Info</TH><TH>���</TH><TH>Default</TH><TH>���-��</TH></TR>
<?
foreach($CFG->Directum->DBs As $DB):
 mssql_select_db($DB, $CFG->Directum->h);
 $q=mssql_query(<<<SQL
Select
 T.*,
 (Select Count(*)From SBEDocSignature Where Author=P.Analit) As N
From
 mbUser U, mbAnalit P, mbVidAn V, MBAnValR2 T
Where
 U.NeedEncode='W' And U.UserKod=P.Dop And
 P.Vid=V.Vid And V.Kod='���' And T.Analit=P.Analit
 And U.UserLogin=
SQL
    .mssql_escape($CFG->params->u));
 while($r=mssql_fetch_assoc($q)):
  echo "<!--"; print_r($r); echo "-->";
  echo "<TR><TD>", htmlspecialchars($DB),
    "<BR /></TD><TD>", '<A hRef="./', htmlspecialchars(hRef('cer', $r[NumStr], 'db', $DB)), '">', htmlspecialchars($r[NumStr]), '</A>',
    "<BR /></TD><TD>", htmlspecialchars($r[StrokaT2]), 
    "<BR /></TD><TD>", htmlspecialchars($r[CertificateInfo]), 
    "<BR /></TD><TD>", cerType($r[CertificateType]), 
    "<BR /></TD><TD>", cerDef($r[DefaultCert]), 
    "<BR /></TD><TD>", '<A hRef="/omz/stat/?x=sig&u=', htmlspecialchars(urlencode($CFG->params->u)), '" Target="_blank">', htmlspecialchars($r[N]), '</A>',
    "<BR /></TD></TR>\n";
 endwhile;

endforeach;

function cerType($c)
{
 switch($c)
 {
  case '�': return '��� � ����������';
  case '�': return '���';
  case '�': return '����������';
 }
 return '?';
}

function cerDef($c)
{
 switch($c)
 {
  case '�': return '��';
  case '�': return '���';
 }
 return '?';
}

?>
</Table>
<!--
&raquo;
���� � ������������ ���� <A hRef="./<?=htmlspecialchars(hRef('x', 'rsa'))?>">����������</A>, �� �� ����� �������� � Directum �������������
-->
<? if($CFG->intraNet): ?>
&raquo;
���� � ���� ������ ���� �� ��� ����������� � ������� <A hRef="./<?=htmlspecialchars(hRef('x', 'pki'))?>">���</A>, �� ����� �������� �� ����������� � ���, �������� ��������������� ������� �� ������� Directum.
<?  endif; ?>
