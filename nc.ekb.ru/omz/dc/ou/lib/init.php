<?
LoadLib('/tabs');

$CFG->H1=$CFG->title='�������������';

$CFG->params->ou=$g=trim($_REQUEST['ou']);

if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'�����');
else:
 $CFG->tabs=Array(
    'list' => '������', 
    search => '�����', 
    data => '������', 
    '2xls' => '�������',
    bcc => '��������',
    // login => 'Login', 
);
// if('stas'==$CFG->u) $CFG->tabs['users']='������������';
 $CFG->ufn=new ufn($CFG->params->ou);
 $CFG->odn=$CFG->ufn->dn();
 if(!$CFG->odn->Canonic()):
  unset($CFG->odn);
  $CFG->tabs=Array('no'=>'������');
 else: 
  if('delete'==$CFG->params->x)
   $CFG->tabs['delete']='��������';
 endif;
endif;

if($CFG->odn):
 if($CFG->params->ou) $CFG->title.=': '.$CFG->params->ou;
 else $CFG->H1=$CFG->title='����������';
endif;
$CFG->title.=' ['.tabName().']';


tabsInit();
?>
