<?
require('../lib/uxm.php');

$AH=apache_request_headers();
if('POST'==$_SERVER['REQUEST_METHOD'] and $AH['x-pfx'])
  LoadLib('pfx');

$AH=0;

LoadLib('/tabs');

$CFG->tabs=Array('u'=>'Пользователь', 'pass'=>'Пароль', 'netlogon'=>'Скрипт', /*'nw'=>'Novell', */'ua'=>'Браузер', 'mig'=>'Миграция');
//if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')>0 /*and 'stas'==$CFG->u*/) $CFG->tabs['os']='ОС';
if(!$CFG->Auth and $CFG->params->x!='pass'):
 unset($CFG->tabs['pass']);
 unset($CFG->tabs['mig']);
endif;
//if(!$CFG->Auth) unset($CFG->tabs['nw']);
if(!$CFG->Auth) unset($CFG->tabs['netlogon']);
if('ok'==$CFG->params->x) $CFG->tabs['ok']='Результат';

if('stas'==$CFG->u) $CFG->tabs['ssl']='ЭЦП';

tabsBeforeBody();
uxmHeader('Сведения');
?>
<H1>Сведения</H1>
<?
tabsBody();
?>
</body></html>
