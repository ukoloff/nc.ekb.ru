<?
$rid = preg_replace('/\W+/', '', $_REQUEST['h']);
$q = mssql_query(
<<<SQL
With
  {$CFG->cte->Rab},
  {$CFG->cte->Fiz},
  {$CFG->cte->Psp},
  {$CFG->cte->Hist},
  {$CFG->cte->Dept},
  {$CFG->cte->Org},
  {$CFG->cte->Tit},
  {$CFG->cte->Stf},
  {$CFG->cte->Evnt},
  {$CFG->cte->Sex}
Select
 Rab.id,
 Rab.tabNo, Rab.FIO,
 Wage,
 bdate,
 F, I, O, INN, SNILS,
 [user],
 Concat(Psp.Series, ' ', Psp.Number) As Passport,
 Psp.cdate As pdate,
 nickname, longname,
 Dept.Kod As deptNo,
 Dept.name As dname,
 Dept.id As deptId,
 Tit.name As title,
 Stf.name As stitle,
 Evnt.value As event,
 CAST(ctime As date) as cdate,
 Sex.value As sex
From
  Rab 
  Join Fiz On fiz_id = Fiz.id
  Join Hist On Hist.rab_id = Rab.id
  Left Join Dept On dept_id = Dept.id
  Join Tit On pos_id = Tit.id
  Join Stf On staff_id = Stf.id
  Left Join Org On Hist.org_id=Org.id
  Join Evnt On event_id=Evnt.id
  Join Sex On sex_ref=Sex.id
  Left Join Psp on Psp.fiz_id = Fiz.id
Where
  Rab.id = 0x$rid
SQL
);

$row = mssql_fetch_assoc($q);

$deptId = bin2hex($row['deptId']);
$q = mssql_query(<<<SQL
With
  {$CFG->cte->Dept},
Tree As(
    Select
        name,
        up_id,
        0 As Level
    From Dept
    Where id = 0x$deptId
    UNION ALL
    Select 
        Dept.name,
        Dept.up_id,
        Level + 1
    From Tree
        Join Dept On Tree.up_id = Dept.id
)
Select 
    STRING_AGG(name, ' / ')
    WITHIN GROUP(Order By Level DESC)
From Tree
Where Level > 0
SQL
);

$upDept = mssql_fetch_row($q);
$upDept = $upDept[0];

function sex2str($i) {
  switch ($i) {
    case 0: return '��';
    case 1: return '��';
  }
  return "#$i";
}

$CFG->Attrs[]=Array(Name=>'���',	Value=>$row['FIO']); # , Field=>'displayName');
$CFG->Attrs[]=Array(Name=>'�������',	Value=>$row['F'],	Field=>'sn');
$CFG->Attrs[]=Array(Name=>'���',	Value=>$row['I'],	Field=>'givenName');
$CFG->Attrs[]=Array(Name=>'��������',	Value=>$row['O'],	Field=>'middleName');
$CFG->Attrs[]=Array(Name=>'���',	Value=>sex2str($row['sex']));
$CFG->Attrs[]=Array(Name=>'���� ��������',	Value=>$row['bdate']);
$CFG->Attrs[]=Array(Name=>'�������',	Value=>$row['Passport']);
$CFG->Attrs[]=Array(Name=>'�����',	Value=>$row['pdate']);
$CFG->Attrs[]=Array(Name=>'��������� �',	Value=>$row['tabNo'],	Field=>'employeeID');
$CFG->Attrs[]=Array(Name=>'������',	Value=>number_format($row['Wage'], 1));
$CFG->Attrs[]=Array(Name=>'���',	Value=>$row['INN']);
$CFG->Attrs[]=Array(Name=>'�����',	Value=>$row['SNILS']);
$CFG->Attrs[]=Array(Name=>'���������',	Value=>$row['title'],	Field=>'title');
$CFG->Attrs[]=Array(Name=>'�� �/����������',	Value=>$row['stitle']);
$CFG->Attrs[]=Array(Name=>'�������������',	Value=>$row['dname']);
$CFG->Attrs[]=Array(Name=>'���',	Value=>$row['deptNo']);
$CFG->Attrs[]=Array(Name=>'� �������',	Value=>$upDept);
$CFG->Attrs[]=Array(Name=>'�����������',	Value=>$row['longname']);
$CFG->Attrs[]=Array(Name=>'(������)',	Value=>$row['nickname']);
if ($row['user']) 
  $CFG->Attrs[]=Array(Name=>'������� ������',	Value=>$row['user'], URL=>'../user/'.hRef('u', $row['user'], 'x'));
$CFG->Attrs[]=Array(Name=>'������',	Value=>$row['event']==2 ? $row['cdate'] : '-');

?>
