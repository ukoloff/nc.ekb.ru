<?
$q=$CFG->entry->q;

$Top=''; $Order='2, 3, 4';
switch($CFG->entry->as)
{
 case 'i': $COL='FirstName'; break;
 case 'o': $COL='MidName'; break;
 case 'n': $q=preg_replace('/[^0-9]/', '', $q); $COL='SSNO';  $Where="$COL Like '$q%' Or $COL Like '0$q%'"; break;
 case 'l': $q=(int)$q; if($q<=0) $q=30; $Top="Top($q)"; $Order='1 Desc'; $Where='1=1'; break;
 case 'd': $COL='DEPT.Name'; break;
 default: $COL='LastName';
}
if(!$Where)
  $Where="$COL Like '".strtr($q, array("'"=>"''"))."%'";

$q=mssql_query(<<<SQL
Select $Top
    X.ID, X.LastName, X.FirstName, X.MidName, X.SSNO As TabNumber, 
    DEPT.Name As Dept, TITLE.NAME As Title,
    (Select Top 1 Convert(VarChar, EVENT_TIME_UTC, 20) From EVENTS Where EMPID=X.ID Order By 1 Desc) As PassTime
From EMP As X
    Left Join UDFEMP As Z On X.ID=Z.ID
    Left Join DEPT	On Z.DEPT=DEPT.ID
    Left Join Title	On Z.Title=Title.ID
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
    htmlspecialchars($r['LastName'].' '.$r['FirstName'].' '.$r['MidName']),
    '<BR /></TD><TD>', htmlspecialchars($r['Dept']),
    '<BR /></TD><TD>', htmlspecialchars(trim($r['Title'])),
    '<BR /></TD><TD><Small>', htmlspecialchars(utc2str($r['PassTime'])), "<A Target='_blank' Title='История проходов' ",
    "hRef='./", htmlspecialchars(hRef('i', $r['ID']).'&pass'), "'>&raquo;</A></Small>",
    "<BR /></TD></TR>\n";
//  print_r($r);
endwhile;

?>
</Table>
