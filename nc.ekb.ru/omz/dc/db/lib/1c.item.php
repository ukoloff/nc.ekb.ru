<?
$q=mssql_query(<<<SQL
Select
    W._Code As tabNo, W._Description as FIO, 
    FIO._Fld6277 As F, FIO._Fld6278 As I, FIO._Fld6279 As O,
    Pas._Fld5561 As pS, Pas._Fld5562 As pN, Convert(VarChar, Pas._Fld5563, 104) As pDate, Pas._Fld5564 As pWhom, 
    W._Fld1203 As Salary, Convert(VarChar, W._Fld7067, 104) As hireDate, Convert(VarChar, W._Fld7068, 104) As fireDate,
    Convert(VarChar, P._Fld1377, 104) As Birth, P._Fld1378 As INN,
    Dept._Code As deptNo, Dept._Description As deptName, 
    Job._Code As jobCode, Job._Description As jobName, 
    Job2._Code As jobCode2, Job2._Description As jobName2
From
    _Reference90 As W
    Left Join _InfoRg6275 As FIO On W._Fld1187RRef=FIO._Fld6276RRef
    Left Join _Reference72 As Dept On W._Fld7065RRef=Dept._IDRRef
    Left Join _Reference39 As Job On Job._IDRRef=W._Fld1197RRef
    Left Join _Reference39 As Job2 On Job2._IDRRef=W._Fld7066RRef
    Left Join _Reference107 As P On P._IDRRef=W._Fld1187RRef
    Left Join _InfoRg5558 As Pas On Pas._Fld5559RRef=W._Fld1187RRef
Where W._Code=
SQL
.$CFG->entry->i);

$r=mssql_fetch_assoc($q);

$CFG->Attrs[]=Array(Name=>'Фамилия',	Value=>$r['F'],	Field=>'sn');
$CFG->Attrs[]=Array(Name=>'Имя',	Value=>$r['I'],	Field=>'givenName');
$CFG->Attrs[]=Array(Name=>'Отчество',	Value=>$r['O'],	Field=>'middleName');
$CFG->Attrs[]=Array(Name=>'Табельный №',	Value=>$CFG->entry->i,	Field=>'employeeID');
$CFG->Attrs[]=Array(Name=>'Дата рождения',	Value=>$r['Birth']);
$CFG->Attrs[]=Array(Name=>'ИНН',	Value=>$r['INN']);
$CFG->Attrs[]=Array(Name=>'Паспорт',	Value=>($r['pS'].'/'.$r['pN']));
$CFG->Attrs[]=Array(Name=>'Выдан',	Value=>($r['pDate'].' '.$r['pWhom']));
$CFG->Attrs[]=Array(Name=>'Подразделение',	Value=>trim($r['deptNo']).': '.$r['deptName']);
$CFG->Attrs[]=Array(Name=>'Должность',	Value=>$r['jobName'],	Field=>'title');
$CFG->Attrs[]=Array(Name=>'Должность 2',	Value=>$r['jobName2']);
$CFG->Attrs[]=Array(Name=>'Принят',	Value=>$r['hireDate']);
$CFG->Attrs[]=Array(Name=>'Уволен',	Value=>(preg_match('/1753$/', $r['fireDate'])? '-': $r['fireDate']));

?>
