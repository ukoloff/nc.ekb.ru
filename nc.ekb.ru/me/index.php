<?
require('../lib/uxm.php');

$AH=apache_request_headers();
if('POST'==$_SERVER['REQUEST_METHOD'] and $AH['x-pfx'])
  LoadLib('pfx');

$AH=0;

LoadLib('/tabs');

$CFG->tabs=Array('u'=>'������������', 'pass'=>'������', 'netlogon'=>'������', /*'nw'=>'Novell', */'ua'=>'�������', 'mig'=>'��������');
//if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')>0 /*and 'stas'==$CFG->u*/) $CFG->tabs['os']='��';
if(!$CFG->Auth and $CFG->params->x!='pass'):
 unset($CFG->tabs['pass']);
 unset($CFG->tabs['mig']);
endif;
//if(!$CFG->Auth) unset($CFG->tabs['nw']);
if(!$CFG->Auth) unset($CFG->tabs['netlogon']);
if('ok'==$CFG->params->x) $CFG->tabs['ok']='���������';

if('stas'==$CFG->u) $CFG->tabs['ssl']='���';

tabsBeforeBody();
uxmHeader('��������');
?>
<H1>��������</H1>
<?
tabsBody();
?>
</body></html>
