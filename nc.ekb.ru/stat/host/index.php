<?
require('../../lib/uxm.php');

if(!preg_match('/^(\\d+\\.){4}$/', ($CFG->params->ip=trim($_REQUEST['ip'])).".")) $CFG->params->ip='';

$backLinks=inGroupX('#Statistics');

uxmHeader('��������� ['.$CFG->params->ip.']');
?>
<H1>���������
<Table Border CellSpacing='0'>
<TR><TH Align='Right'>IP-�����</TH><TD><?=$CFG->params->ip?></TD></TR>
<TR><TH Align='Right'>��� ����������</TH><TD><?= 
 htmlspecialchars(preg_replace('/\\.uxm$/', '', sqlGet("Select host From ip2host Where ip='{$CFG->params->ip}' And Month='{$CFG->params->m}'")))
?><BR /></TD></TR>
</Table>
</H1>
<BR />
<?
if(preg_match('/^192\\.168\\.\\d\\./', $CFG->params->ip))
 $Msg='���� ����� ��������������� ��� ������� � ����� � ���� �� ������';
elseif(preg_match('/^127\\./', $CFG->params->ip))
 $Msg='�� ���� ����� �������������� ������ ����� ����� <A hRef="/mail/">���-���������</A>,
� ����� ���� �� ���� �������� ������ ��� ������������� ��������� ������-�������';

if($Msg):
 echo $Msg, ". ���������� �� ���� �� ������������.\n</body></html>";
 exit;
endif;

LoadLib('/ditobj');
LoadLib('/sort');
//$CFG->sort['u']=Array('field'=>'u', 'name'=>'������������', 'title'=>'������� ������, ��� ������� ������������� ������');
$CFG->sort['b']=Array('field'=>'b', 'name'=>'��', 'rev'=>1, 'title'=>'�������� ������, ��������');
$CFG->sort['m']=Array('field'=>'mail', 'name'=>'�����', 'title'=>'�������������� �� ������ �����');
$CFG->sort['w']=Array('field'=>'www', 'name'=>'WWW', 'title'=>'������������� �� ���� �� ���� �������� ������');
$CFG->sort['o']['name']='�����';
$CFG->sort['n']['name']='������������';
$CFG->defaults->oClasses='u';
$CFG->defaults->sort='b';

$q=mysql_query("Select * From ipUse Where ip='{$CFG->params->ip}' And Month='{$CFG->params->m}'");
while($r=mysql_fetch_object($q)):
 $x=getObject(user2dn($r->u));
 if(!$x) continue;
 $x->b=$r->b;
 $x->mail=$r->mail;
 $x->www=$r->www;
 $Items[]=$x;
endwhile;
sortArray($Items);
sortedHeader('noibmw');
if(is_array($Items))
foreach($Items as $x):
 echo "<TR><TD>", htmlspecialchars($x->name), "</TD><TD>", htmlspecialchars($x->ou), "</TD><TD>";
 if($backLinks) echo '<A hRef="../', hRef('u', $x->id, 'x', 'where'), '">';
 echo htmlspecialchars($x->id);
 if($backLinks) echo "</A>";
 echo "</TD><TD Align='Right'>";
 if($x->b) printf("%.1f", $x->b/1024/1024);
 echo "<BR /></TD><TD Align='Center'>", $x->mail?'+':'-', "</TD><TD Align='Center'>", $x->www?'+':'-', "</TD></TR>\n";
endforeach;
sortedFooter();

echo "<Center><H3>��� ������</H3>";
LoadLib('../summary');
unset($Min); 
$q=mysql_query("Select Month, count(*) N From ipUse Where ip='{$CFG->params->ip}' Group By Month Order By Month");
while($r=mysql_fetch_object($q)):
 $X[$Max=$r->Month]=$r->N;
 if(!$Min)$Min=$Max;
endwhile;

$i=new monthIterator($Min, $Max); 
while($i->Advance())
 if($m=$i->m() and $n=$X[$m])
  echo '<A hRef="./', hRef('m', $m), "\">$n</A>";


?>
</Center>
<Small>
�� ���� �������� �������� ��� ������������, ���������� �� ���������� [<?=htmlspecialchars($CFG->params->ip)?>]. 
<UL>
<LI>���� "��" �������� ���������� ����������, ��������� ������������� � ����� ���������� �� ���������.
<LI>� ���� "�����" ����� "+", ���� ������������ ����� ����� � ����� ����������.
<LI>� ���� "WWW" ����� "+", ���� ������������ ������� � ����� ���������� �� ���� �������� ������ (���� ����)
</UL>
���� �� ������� � ���� ������, �� ���������� �� �� �������� �� ���� ���������� - ������, ������, ����� ��������
����� ���������� ����� ��� ������. � ���� ������ ����������� ���������� <A hRef='/pass/'>������� ������</A>!
<P>
������ ���������� ��������� ���������� ����� ����� �� ���� �����, ��� �� ������ ����� � ����� ����������. 
����� ����� ��������� ���������� ����� ���������� ��������� �������������.
</Small>
</body></html>
