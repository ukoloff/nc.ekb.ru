<?
$s = $CFG->sigur->prepare(<<<SQL
with RECURSIVE X as (
    select ID,
        PARENT_ID,
        NAME,
        0 As Level
    from personal
    where id = ?
    UNION ALL
    Select Y.ID,
        Y.PARENT_ID,
        Y.NAME,
        Level + 1
    From X
        JOIN personal Y ON X.PARENT_ID = Y.ID
)
Select group_concat(
        NAME
        Order By Level Desc separator ' / '
    )
From X
Where level > 1
SQL
);
$s->execute(Array($CFG->entry->i));
$row = $s->fetch();
$DeptsUp = $row[0];

$s = $CFG->sigur->prepare(<<<SQL
With LOG As(
    SELECT *
    From `tc-db-log`.logs
    Where substr(LOGDATA, 1, 2) = 0xFE06
)
select P.*,
    D.NAME As Dept,
    (
        Select Min(LOGTIME)
        From LOG
        Where EMPHINT = P.ID
    ) As PassA,
    (
        Select Max(LOGTIME)
        From LOG
        Where EMPHINT = P.ID
    ) As PassZ,
    char_length(HIRES_RASTER) As szImg
From personal As P
    Left join personal As D On P.PARENT_ID = D.ID
    left JOIN photo As X On X.ID = P.ID
Where P.ID = ?
SQL
);
$s->execute(Array($CFG->entry->i));
$row = $s->fetch();

$CFG->Attrs[]=Array(Name=>'ФИО',		Value=>$row['NAME'],	Field=>'displayName');
$CFG->Attrs[]=Array(Name=>'Табельный №',	Value=>$row['TABID'], Field=>'employeeID');
$CFG->Attrs[]=Array(Name=>'Должность',		Value=>$row['POS'],	Field=>'title');
$CFG->Attrs[]=Array(Name=>'Подразделение',	Value=>$row['Dept']);
$CFG->Attrs[]=Array(Name=>'В составе',		Value=>$DeptsUp);
$CFG->Attrs[]=Array(Name=>'Примечание',		Value=>$row['DESCRIPTION']);
$CFG->Attrs[]=Array(Name=>'AD',			Value=>$row['AD_USER_DN']);
$CFG->Attrs[]=Array(Name=>'Оператор',		Value=>$row['USER_ENABLED'] ? '+' : '-');
$CFG->Attrs[]=Array(Name=>'Первый проход',	Value=>$row['PassA']);
$CFG->Attrs[]=Array(Name=>'Крайний проход',	Value=>$row['PassZ'],	URL=>'./'.hRef('pass', 1, 'i', $CFG->entry->i));
$CFG->Attrs[]=Array(Name=>'Создан',		Value=>$row['CREATEDTIME']);
$CFG->Attrs[]=Array(Name=>'Уволен',		Value=>$row['FIREDTIME']);
if($row['szImg'])
    $CFG->Attrs[]=Array(Photo=>$CFG->params->x.'/'.$CFG->entry->i, Thumb=>'./'.hRef('i', $CFG->entry->i).'&jpg');

//echo "<pre>";
//print_r($row);
?>
