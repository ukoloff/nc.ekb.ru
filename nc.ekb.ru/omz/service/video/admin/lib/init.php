<?
$CFG->title='��������� ���������������';
$CFG->AAA=2;
if(!$CFG->Dispatcher) return;

$CFG->AAA=1;

LoadLib('/tabs');
LoadLib('../db');

//if('stas'==$CFG->u and $CFG->params->db2=$_REQUEST['db2']) mssql_select_db('VideoTest');	// ���������� ��

$CFG->tabs=Array(cameras=>'������');
if($CFG->Dispatcher>1)
 $CFG->tabs+=Array(lists=>'������', logins=>'������������'/*, users=>'�������'*/);
$CFG->tabs+=Array(orders=>'������', customers=>'���������');
if('stas'==$CFG->u)$CFG->tabs+=Array(config=>'�����');
$X=Array(cam=>'������', customer=>'��������', order=>'�����');
if($CFG->Dispatcher>1)
 $X+=Array(camera=>'������', 'list'=>'������', /*user=>'�������',*/ login=>'������������');

if($X[$CFG->params->x]) $CFG->tabs[$CFG->params->x]=$X[$CFG->params->x];

tabsInit();
$CFG->onLoadLib['body']='tabsBody';

?>
