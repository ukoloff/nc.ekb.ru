<?
$q=mssql_query(<<<SQL
Select
    Z.ID, Name, FirstName, MidName, TabNumber, Address, DataLength(Picture) As szPic,
    CONVERT(varchar, BirthDate, 104) AS Birth,
    CONVERT(varchar, ChangeTime, 120) AS Chg,
    (Select Name From pDivision Where ID=Section) As Dept,
    (Select Name From pPost Where ID=Post) As Title,
    (Select Name From pCompany Where ID=Company) As Org,
    (Select CONVERT(varchar, Min(TimeVal), 120) From pLogData Where Event=32 And HozOrgan=Z.ID) As Pass1,
    (Select CONVERT(varchar, Max(TimeVal), 120) From pLogData Where Event=32 And HozOrgan=Z.ID) As PassTime,
    CONVERT(varchar, X.Start, 120) As notBefore,
    CONVERT(varchar, X.Finish, 120) As notAfter
From pList As Z
    Left Join pMark As X On X.Owner=Z.ID
Where Z.ID=
SQL
.$CFG->entry->i);

$r=mssql_fetch_assoc($q);

$CFG->Attrs[]=Array(Name=>'�������',	Value=>$r['Name'],	Field=>'sn');
$CFG->Attrs[]=Array(Name=>'���',	Value=>$r['FirstName'],	Field=>'givenName');
$CFG->Attrs[]=Array(Name=>'��������',	Value=>$r['MidName'],	Field=>'middleName');
$CFG->Attrs[]=Array(Name=>'��������� �',	Value=>preg_replace('/^0+/', '', $r['TabNumber']),Field=>'employeeID');
$CFG->Attrs[]=Array(Name=>'���������',	Value=>$r['Title'],	Field=>'title');
$CFG->Attrs[]=Array(Name=>'�������������',	Value=>$r['Dept']);
$CFG->Attrs[]=Array(Name=>'������ ������',	Value=>$r['Pass1']);
$CFG->Attrs[]=Array(Name=>'������� ������',	Value=>$r['PassTime'],	URL=>'./'.hRef('pass', 1, 'i', $CFG->entry->i));
$CFG->Attrs[]=Array(Name=>'��������',	Value=>$r['Org']);
$CFG->Attrs[]=Array(Name=>'���� ��������',	Value=>preg_match('/\.1899$/', $r['Birth'])? '-':$r['Birth']);
$CFG->Attrs[]=Array(Name=>'�����',	Value=>$r['Address']);
$CFG->Attrs[]=Array(Name=>'�����������',	Value=>$r['Chg']);
$CFG->Attrs[]=Array(Name=>'����������� �',	Value=>$r['notBefore']);
$CFG->Attrs[]=Array(Name=>'����������� ��',	Value=>$r['notAfter']);
if($r['szPic'])
    $CFG->Attrs[]=Array(Photo=>$CFG->params->x.'/'.$CFG->entry->i, Thumb=>'./'.hRef('i', $CFG->entry->i).'&jpg');

/* Card Code

Select
sys.fn_varbintohexstr(cast(Reverse(Left(CodeP, 5)) As varbinary(3))),
sys.fn_varbintohexstr(CONVERT(VARBINARY(3), 12261824)),
sys.fn_varbintohexstr(cast(CodeP As varbinary)),
sys.fn_varbintohexstr(cast(CodePAdd As varbinary)),
*
From pMark Where Owner=2085
*/
?>
