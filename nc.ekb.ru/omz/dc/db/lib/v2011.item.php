<?
$q=mssql_query(<<<SQL
Select
    X.ID, X.LastName, X.FirstName, X.MidName, X.SSNO As TabNumber, ADDR1,
    DataLength(LNL_BLOB) As szPic,
    CONVERT(varchar, BDate, 104) AS Birth, 
    CONVERT(varchar, X.LastChanged, 120) AS Chg,
    DEPT.Name As Dept,
    TITLE.Name As Title,
    (Select CONVERT(varchar, Min(EVENT_TIME_UTC), 20) From EVENTS Where EMPID=X.ID) As Pass1,
    (Select CONVERT(varchar, Max(EVENT_TIME_UTC), 20) From EVENTS Where EMPID=X.ID) As PassTime,
    CONVERT(varchar, Badge.Activate, 120) AS notBefore,
    CONVERT(varchar, Badge.Deactivate, 120) AS notAfter
From EMP As X
    Left Join UDFEMP As Z On X.ID=Z.ID
    Left Join DEPT      On Z.DEPT=DEPT.ID
    Left Join Title     On Z.Title=Title.ID
    Left Join MMOBJS As Y On Y.EMPID=X.ID And Y.OBJECT=1 And Y.TYPE=0
    left Join Badge On  Badge.EMPID=X.ID
Where X.ID=
SQL
.$CFG->entry->i);

$r=mssql_fetch_assoc($q);

$CFG->Attrs[]=Array(Name=>'Фамилия',	Value=>$r['LastName'],	Field=>'sn');
$CFG->Attrs[]=Array(Name=>'Имя',	Value=>$r['FirstName'],	Field=>'givenName');
$CFG->Attrs[]=Array(Name=>'Отчество',	Value=>$r['MidName'],	Field=>'middleName');
$CFG->Attrs[]=Array(Name=>'Табельный №',	Value=>preg_replace('/^0+/', '', $r['TabNumber']),Field=>'employeeID');
$CFG->Attrs[]=Array(Name=>'Должность',	Value=>$r['Title'],	Field=>'title');
$CFG->Attrs[]=Array(Name=>'Подразделение',	Value=>$r['Dept']);
$CFG->Attrs[]=Array(Name=>'Первый проход',	Value=>utc2str($r['Pass1']));
$CFG->Attrs[]=Array(Name=>'Крайний проход',	Value=>utc2str($r['PassTime']),	URL=>'./'.hRef('pass', 1, 'i', $CFG->entry->i));
$CFG->Attrs[]=Array(Name=>'Дата рождения',	Value=>preg_match('/\.1899$/', $r['Birth'])? '-':$r['Birth']);
$CFG->Attrs[]=Array(Name=>'Адрес',	Value=>$r['ADDR1']);
$CFG->Attrs[]=Array(Name=>'Модификация',	Value=>$r['Chg']);
$CFG->Attrs[]=Array(Name=>'Активирован с',	Value=>$r['notBefore']);
$CFG->Attrs[]=Array(Name=>'Активирован по',	Value=>$r['notAfter']);
if($r['szPic'])
    $CFG->Attrs[]=Array(Photo=>$CFG->params->x.'/'.$CFG->entry->i, Thumb=>'./'.hRef('i', $CFG->entry->i).'&jpg');

mssql_query('SET ANSI_NULLS ON');
mssql_query('SET ANSI_WARNINGS ON');

/*
$q=mssql_query(<<<SQL
Select 
  Q.ID, Q.Name+' '+Q.FirstName+' '+Q.MidName
From 
EMP As X
 Inner Join Badge As Y On X.ID=Y.EMPID 
 Inner Join SERVSKD.Orion12.dbo.pMark As Z On 
   Y.ID=Cast(Cast(Reverse(Left(Z.CodeP, 5)) As VarBinary(3))As Int)
 Inner Join SERVSKD.Orion12.dbo.pList As Q On Z.Owner=Q.ID
Where 
    X.ID=
SQL
.$CFG->entry->i);
while($r=mssql_fetch_row($q)):
 $CFG->Attrs[]=Array(Name=>'В старой базе', Value=>$r[1], URL=>'./'.hRef('x', 'v2010', 'i', $r[0]));
endwhile;
*/

/*
Select 
Z.OwnerName, Q.TabNumber, X.*
From 
EMP As X
Left Join Badge As Y On X.ID=Y.EMPID And Y.Deactivate>GetDate()
Left Join SERVSKD.Orion12.dbo.pMark As Z On 
  Y.ID=Cast(Cast(Reverse(Left(Z.CodeP, 5)) As VarBinary(3))As Int)
Left Join SERVSKD.Orion12.dbo.pList As Q On Z.Owner=Q.ID
*/

?>
