<?
$CFG->title='Настройка видеонаблюдения';
$CFG->AAA=2;
if(!$CFG->Dispatcher) return;

$CFG->AAA=1;

LoadLib('/tabs');
LoadLib('../db');

//if('stas'==$CFG->u and $CFG->params->db2=$_REQUEST['db2']) mssql_select_db('VideoTest');	// Отладочная БД

$CFG->tabs=Array(cameras=>'Камеры');
if($CFG->Dispatcher>1)
 $CFG->tabs+=Array(lists=>'Списки', logins=>'Пользователи'/*, users=>'Внешние'*/);
$CFG->tabs+=Array(orders=>'Заказы', customers=>'Заказчики');
if('stas'==$CFG->u)$CFG->tabs+=Array(config=>'Текст');
$X=Array(cam=>'Камера', customer=>'Заказчик', order=>'Заказ');
if($CFG->Dispatcher>1)
 $X+=Array(camera=>'Камера', 'list'=>'Список', /*user=>'Внешний',*/ login=>'Пользователь');

if($X[$CFG->params->x]) $CFG->tabs[$CFG->params->x]=$X[$CFG->params->x];

tabsInit();
$CFG->onLoadLib['body']='tabsBody';

?>
