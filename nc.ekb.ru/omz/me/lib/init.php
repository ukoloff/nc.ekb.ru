<?
$CFG->title='��� ���';

LoadLib('/tabs');
$CFG->tabs=Array(u=>'������������', pass=>'������', netlogon=>'������', ua=>'�������', /*mig=>'��������'*/ owa=>'����������� �����');
if(!$CFG->Auth) $CFG->defaults->x='ua';

if('ok'==$CFG->params->x) $CFG->tabs['ok']='���������';

if('remind'==$CFG->params->x or inGroupX('#browseDIT')) $CFG->tabs['remind']='���������';

//LoadLib('/dc/user/rsa.export');

//if('stas'==$CFG->u) 
$CFG->tabs[pki]='���';

$CFG->onLoadLib['body']='tabsBody';

tabsInit();
?>
