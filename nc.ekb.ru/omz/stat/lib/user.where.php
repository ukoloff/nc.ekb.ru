<?
LoadLib('/sort');
LoadLib('/pages');
LoadLib('summary');
$CFG->sort=Array(
    'h'=>Array('field'=>'host', 'name'=>'���������', 'title'=>'��� ����������, � �������� ���������� ������'),
    'i'=>Array('field'=>'ip', 'name'=>'IP-�����', 'title'=>'IP-����� ����������, � �������� ���������� ������'),
    'b'=>Array('field'=>'b', 'name'=>'��', 'title'=>'������, ���������� �� ��������� ���������'),
    'm'=>Array('field'=>'mail', 'name'=>'�����', 'title'=>'������������� �� ������ ����� � ����� ����������'),
    'w'=>Array('field'=>'www', 'name'=>'WWW', 'title'=>'���� �� ���� �������� ������'),
);
$CFG->defaults->sort='Bm';

$q=mysql_query(<<<SQL
Select i.ip, host, b, mail, www
From ipUse i Left Join ip2host Using(ip, Month)
Where u={$CFG->uSQL} And i.Month={$CFG->params->m}
SQL
.sqlOrderBy());
if(($lineNo=mysql_num_rows($q))>0):
 if($lineNo=PageStart($lineNo))
   mysql_data_seek($q, $lineNo);
 PageNavigator();
 sortedHeader('hibmw');
 while($r=mysql_fetch_object($q)):
  echo "<TR Align='Right'><TD>", 
    htmlspecialchars(preg_replace('/\\.uxm$/', '', $r->host)), 
    '<BR /></TD><TD><A x-hRef="host/', hRef('ip', $r->ip), '">',
    htmlspecialchars($r->ip), "</A><BR /></TD><TD>",
    $r->b? n2M($r->b) : '<BR />', "</TD><TD Align='Center'>",
    $r->mail ? '+' : '<BR />', '</TD><TD Align="Center">', 
    $r->www ? '+' : '<BR />', "</TD></TR>\n";
  if(isLastLine($lineNo++))break;
 endwhile;
 sortedFooter();
 PageNavigator();
 echo "<Div Align='Left'><Small>&raquo;��� ������� ���������� �������:
<LI>������� ��������-������� (� ����������),
���� �������� �� ���� ���������
<LI>�������������� �� � ���� ������ ����� � ���� ������,
<LI>� ������������� �� � ���� ���� �� ���� �������� ������ (���� ����)</Small></Div>";
endif;
PagesStop();
echo "<H3>��� ������</H3>\n";

unset($Min); 
$q=mysql_query("Select Month, count(*) N From ipUse Where u={$CFG->uSQL} Group By Month Order By Month");
while($r=mysql_fetch_object($q)):
 $X[$Max=$r->Month]=$r->N;
 if(!$Min)$Min=$Max;
endwhile;

$i=new monthIterator($Min, $Max); 
while($i->Advance())
 if($m=$i->m() and $n=$X[$m])
  echo '<A hRef="./', hRef('m', $m), "\">$n</A>";
 else
  echo "<BR />";
?>
