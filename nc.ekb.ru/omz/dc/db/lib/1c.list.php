<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'>
<TH>Таб. №</TH>
<TH>ФИО</TH>
<TH>Отдел</TH>
<TH>Должность</TH>
<TH>Уволен</TH>
</TR>
<?
$F=Array(
''=>'FIO._Fld6277',
'i'=>'FIO._Fld6278',
'o'=>'FIO._Fld6279',
'n'=>'W._Code',
'd'=>'Dept._Code'
);

$F=$F[$CFG->entry->as];
$Filter=strtr(strtolower($CFG->entry->q), Array("'"=>"''", 'ё'=>'е'));

$q=mssql_query(
<<<SQL
Select
    W._Code As tabNo, W._Description as FIO, Convert(VarChar, W._Fld7068, 104) As hireDate,
    Dept._Code As deptNo, Dept._Description As deptName, 
    Job._Code As jobCode, Job._Description As jobName, 
    Job2._Code As jobCode2, Job2._Description As jobName2
From
    _Reference90 As W
    Left Join _InfoRg6275 As FIO On W._Fld1187RRef=FIO._Fld6276RRef
    Left Join _Reference72 As Dept On W._Fld7065RRef=Dept._IDRRef
    Left Join _Reference39 As Job On Job._IDRRef=W._Fld1197RRef
    Left Join _Reference39 As Job2 On Job2._IDRRef=W._Fld7066RRef
Where $F Like '$Filter%'
Order By 2
SQL
, $CFG->sql);

while($r=mssql_fetch_assoc($q)):
  echo '<TR><TD><A hRef="./', hRef('i', (int)$r['tabNo']), '">', htmlspecialchars(trim($r['tabNo'])), '</A>',
    "<BR /></TD><TD>", htmlspecialchars($r['FIO']),
    "<BR /></TD><TD>", htmlspecialchars(trim($r['deptNo']).': '.$r['deptName']),
    "<BR /></TD><TD>", htmlspecialchars($r['jobName']),
    "<BR /></TD><TD>", preg_match('/1753$/', $r['hireDate'])? '-':htmlspecialchars($r['hireDate']),
    "<BR /></TD></TR>\n";
//  print_r($r);
endwhile;
?>
</Table>
