<?
$CFG->AAA=1;
Header("Refresh: 1500");

$CFG->defaults->m=date("Ym");
if(!preg_match('/^\d{6}$/', $CFG->params->m=trim($_REQUEST['m']))
    or !checkdate(substr($CFG->params->m, 4, 2), 1, substr($CFG->params->m, 0, 4)))
 $CFG->params->m=$CFG->defaults->m;

$CFG->Months=explode(' ', '������ ������� ���� ������ ��� ���� ���� ������ �������� ������� ������ �������');
$CFG->MonthName=$CFG->Months[substr($CFG->params->m, 4, 2)-1].' '.substr($CFG->params->m, 0, 4);

$CFG->title.='����������: '.$CFG->MonthName;

?>
