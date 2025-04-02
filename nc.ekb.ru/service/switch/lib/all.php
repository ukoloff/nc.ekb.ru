<?
global $CFG;

LoadLib('/sort');
$CFG->sort=Array(
    'n'=>Array('field'=>'host', 'name'=>'Имя'),
    'm'=>Array('field'=>'Macs', 'name'=>'M', 'rev'=>1, title=>'Количество MAC-адресов, известных коммутатору'),
    'p'=>Array('field'=>'Ports', 'name'=>'P', 'rev'=>1, title=>'Количество активных портов коммутатора'),
    't'=>Array('field'=>'Name', 'name'=>'Название'),
    'a'=>Array('field'=>'IP', 'name'=>'Адрес'),
    'c'=>Array('field'=>'Location', 'name'=>'Контакт'),
    'd'=>Array('field'=>'Descr', 'name'=>'Примечание'),
);
$CFG->defaults->sort='n';

uxmHeader('Коммутаторы');
?>
<H1>Коммутаторы</H1>
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
