<Form Action='./' Method='Post'>
<?
global $CFG;

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
 CheckBox("Role".$N, '');
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

$e=getEntry($CFG->udn, "cn mail");
$e['cn']=utf2str($e['cn'][0]);
$e['mail']=utf2str($e['mail'][0]);

?>
<Script><!--
function doPaste(Obj)
{
 Obj.blur();
 clipboardData.setData("Text", 'user\t= "'+<?=jsEscape($CFG->params->u)?>+'"\r\ncn\t= "'+<?=jsEscape(transLit($e['cn']))?>+'"\r\n');
// alert('!');
 return false;
}
//--></Script>

&raquo;
�����������:
<?
$x=mssql_query("Select count(*) From Reports..jCertificates Where u=".mssql_escape($CFG->params->u), $CFG->Directum->h);
$y=mssql_fetch_array($x);
$y=$y[0];
echo $y ? "<A hRef='/abook/?crt&u=".htmlspecialchars($CFG->params->u)."'>����</A>[$y]" : "���";
/*
$crtN=0;
while($y=mssql_fetch_object($x)):
 if($crtN++) echo ",\n";
 echo "<A hRef='/abook/crt/?n=", $y->XRecID, "'>", htmlspecialchars($y->Subj), "</A>";
endwhile;
if(!$crtN) echo "-";
*/
?>
<BR />
&raquo;
<!-- ������������ <A hRef='https://directum.lan.uxm/crt/<?=htmlspecialchars(hRef('cn', $e['cn'], 
    'tcn', transLit($e['cn']) /*'mail', $e['mail'], /*, 'u'*/))?>' Target='DirKey'>���� ���</A> ��� ������������ ��� -->
<A hRef='#' onClick='return doPaste(this)'>C����������</A> ������ ��� ��� � ����� ������.


<?

function userStatus($S)
{
 if($S=='�') return '';
 if($S=='�') return '!';	//�����
 if($S=='�') return '#';	//��������
 if($S=='�') return '*';	//�����������
 return '?';
}

?>
<HR />
<Small>
&raquo;
��� ����, ����� ������������ ��� ����� � �� Directum, ����������, ����� ����:
<UL>
<LI>����� ����� �� ������
<LI>������ ������������ SQL � ���� ��
<LI>������ ������������ Directum � ���� ��
<LI>��� ����������� ������������ - Windows (W)
<LI>������������ �� ������������ (#)
</UL>
&raquo;
������������ Directum ����� �����������/��������� ������ � ����� Directum

<!--
user	= "<?=$CFG->params->u?>"
cn	= "<?=transLit($e['cn'])?>"

-->