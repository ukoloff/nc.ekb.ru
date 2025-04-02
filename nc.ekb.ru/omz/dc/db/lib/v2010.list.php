<?
$q=$CFG->entry->q;

$Top=''; $Order='2, 3, 4';
switch($CFG->entry->as)
{
 case 'i': $COL='FirstName'; break;
 case 'o': $COL='MidName'; break;
 case 'n': $q=preg_replace('/[^0-9]/', '', $q); $COL='TabNumber';  $Where="$COL Like '$q%' Or $COL Like '0$q%'"; break;
 case 'l': $q=(int)$q; if($q<=0) $q=30; $Top="Top($q)"; $Order='1 Desc'; $Where='1=1'; break;
 default: $COL='Name';
}
if(!$Where)
  $Where="$COL Like '".strtr($q, array("'"=>"''"))."%'";

$q=mssql_query(<<<SQL
Select $Top
    ID, Name, FirstName, MidName, TabNumber, 
    (Select Name From pDivision Where ID=Section) As Dept,
    (Select Name From pPost Where ID=Post) As Title,
    (Select CONVERT(varchar, Max(TimeVal), 120) From pLogData Where Event=32 And HozOrgan=ID) As PassTime
From pList
Where $Where Order By $Order
SQL
);
?>
<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'>
<TH>Таб.&nbsp;№</TH>
<TH>Ф.И.О.</TH>
<TH>Отдел</TH>
<TH>Должность</TH>
<TH>Проход</TH>
</TR>
<?
unset($CFG->params->q);
while($r=mssql_fetch_assoc($q)):
 echo "<TR><TD><A hRef='./", htmlspecialchars(hRef('i', $r['ID'])), "'>",
    htmlspecialchars(preg_replace('/^0+/', '', $r['TabNumber'])),
    "</A><BR /></TD><TD onMouseMove=\"userThumb(this, ", jsEscape('./'.hRef('i', $r['ID']).'&jpg&w'), ")\">",
    htmlspecialchars($r['Name'].' '.$r['FirstName'].' '.$r['MidName']),
    '<BR /></TD><TD>', htmlspecialchars($r['Dept']),
    '<BR /></TD><TD>', htmlspecialchars(trim($r['Title'])),
    '<BR /></TD><TD><Small>', htmlspecialchars(trim($r['PassTime'])), "<A Target='_blank' Title='История проходов' ",
    "hRef='./", htmlspecialchars(hRef('i', $r['ID']).'&pass'), "'>&raquo;</A></Small>",
    "<BR /></TD></TR>\n";
//  print_r($r);
endwhile;
?>
</Table>
