<?
LoadLib('/tabs');

$CFG->params->g=$g=trim($_REQUEST['g']);
if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'�����');
else:
 $CFG->tabs=Array(
   'sum'=>'������', 
   data=>'������', 
   'list'=>'������', 
   'groups'=>'������ �', 
//   'mbox'=>'�/�',
   bcc => '��������',
 );
 if(!$g or !($CFG->gdn=group2dn($g))):
  $CFG->tabs=Array('no'=>'������');
 else: 
  if('groupz'==$CFG->params->x):
   unset($CFG->tabs['groups']);
   $CFG->tabs['groupz']='������ �';
  endif;
  if('sub'==$CFG->params->x):
   unset($CFG->tabs['list']);
   $CFG->tabs['sub']='���������';
  endif;
  if('delete'==$CFG->params->x)
   $CFG->tabs['delete']='��������';
  if('unix'==$CFG->params->x)
   $CFG->tabs['unix']='Unix';
  if('xls'==$CFG->params->x)
   $CFG->tabs['xls']='XLS';
 endif;
endif;

tabsInit();

$CFG->H1=$CFG->title='������';
if($CFG->gdn) $CFG->title.=': '.$CFG->params->g;
$CFG->title.=" [".tabName()."]";
?>
