<?
LoadLib('/tabs');

$CFG->params->u=$CFG->entry->u=$u=trim($_REQUEST['u']);
if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'�����');
else:
 $CFG->tabs=Array('sum'=>'������', 'pass'=>'������', 
    'ocs' => 'OCS',
    'contact'=>'��������', 'photo'=>'����',
    'rights'=>'�����', 'mbox'=>'�/�', lync=>'Lync', 'groups'=>'������', 
//	'netlogon'=>'������', 
//	wifi=>'Wi-Fi', 
    'directum'=>'2Rectum'/*, rsa=>'���'*/ /*, 'mig'=>'�������'*/);
// if('stas'!=$CFG->u)unset($CFG->tabs['lync']);
 if(!inGroupX('��������� �������������') and !inGroupX('#modifyDIT')) unset($CFG->tabs[photo]);
 if(!inGroupX('#modifyDIT')) unset($CFG->tabs[wifi]);
 LoadLib('/me/pki.export');
// if('stas'==$CFG->u)$CFG->tabs['rsa']='���';
 if(!$u or !($CFG->udn=user2dn($u))):
  $CFG->tabs=Array('no'=>'������');
 elseif(ldap_compare($CFG->AD->h, $CFG->udn, 'objectClass', 'computer')):
  Header("Location: ../host/?".$_SERVER['QUERY_STRING']);
  exit;
 else: 
  $extraTabs=Array('ok'=>'���������', 'groupz'=>'������', 'created'=>'���������', 'unix'=>'Unix', 'mail'=>'��������',
    'json' => '��������',
    'unlock'=>'����� ����');
  if($extraTabs[$CFG->params->x]):
   $CFG->tabs[$CFG->params->x]=$extraTabs[$CFG->params->x];
   if('groupz'==$CFG->params->x)unset($CFG->tabs['groups']);
  endif;
 endif;
endif;

tabsInit();

$CFG->H1=$CFG->title='������������';
if($CFG->udn) $CFG->title.=': '.$CFG->params->u;
$CFG->title.=" [".tabName()."]";
?>
