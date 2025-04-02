<?
$CFG->title='Обо мне';

LoadLib('/tabs');
$CFG->tabs=Array(u=>'Пользователь', pass=>'Пароль', netlogon=>'Скрипт', ua=>'Браузер', /*mig=>'Миграция'*/ owa=>'Электронная почта');
if(!$CFG->Auth) $CFG->defaults->x='ua';

if('ok'==$CFG->params->x) $CFG->tabs['ok']='Результат';

if('remind'==$CFG->params->x or inGroupX('#browseDIT')) $CFG->tabs['remind']='Напомнить';

//LoadLib('/dc/user/rsa.export');

//if('stas'==$CFG->u) 
$CFG->tabs[pki]='ЭЦП';

$CFG->onLoadLib['body']='tabsBody';

tabsInit();
?>
