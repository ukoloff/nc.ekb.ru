<?
global $CFG;

LoadLib('/sort');
$CFG->sort=Array(
    'n'=>Array('field'=>'host', 'name'=>'���'),
    'm'=>Array('field'=>'Macs', 'name'=>'M', 'rev'=>1, title=>'���������� MAC-�������, ��������� �����������'),
    'p'=>Array('field'=>'Ports', 'name'=>'P', 'rev'=>1, title=>'���������� �������� ������ �����������'),
    't'=>Array('field'=>'Name', 'name'=>'��������'),
    'a'=>Array('field'=>'IP', 'name'=>'�����'),
    'c'=>Array('field'=>'Location', 'name'=>'�������'),
    'd'=>Array('field'=>'Descr', 'name'=>'����������'),
);
$CFG->defaults->sort='n';

uxmHeader('�����������');
?>
<H1>�����������</H1>
<Table Border CellSpacing='0'>
<?
$s=sqlite3_query($CFG->db, 'Select * From SwitchX '.sqlOrderBy());
//print('Select * From SwitchX '.sqlOrderBy()); exit;
$X=Array();
while($r=sqlite3_fetch_array($s))
  $X[]=$r;

sqlite3_query_close($s);

#sortArray($X);
sortedHeader('nmptacd');
foreach($X as $r):
 echo "<TR><TD RowSpan='2'><A hRef='./", htmlspecialchars(hRef('n', $r['No'])),"'>",
    htmlspecialchars(preg_replace('/(\.switch)?\.uxm$/', '', $r['Host'])),
    "</A></TD><TD RowSpan='2' Align='Rigth'>", $r['Macs'],
    "</TD><TD RowSpan='2' Align='Right'>", $r['Ports'], "<BR /></TD>";
 $i=0;
 foreach(Array('Name', 'IP', 'Location')as $f)
  echo "<TD><Small>", htmlspecialchars($r[$f]), "</Small><BR /></TD>\n";

 echo "<TD RowSpan='2'><Small>", nl2br(htmlspecialchars($r['Descr'])), "</Small><BR /></TD></TR>\n<TR>";

 foreach(Array('snmpName', 'Mac', 'Contact')as $f)
  echo "<TD><Small>", htmlspecialchars($r[$f]), "</Small><BR /></TD>\n";
 echo "</TR>\n";
endforeach;
sortedFooter();
?>
</Table>
