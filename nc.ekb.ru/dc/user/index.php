<?
require('../../lib/uxm.php');
LoadLib('/tabs');

$CFG->params->u=$CFG->entry->u=$u=trim($_REQUEST['u']);
if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'�����');
else:
 $CFG->tabs=Array('sum'=>'������', 'pass'=>'������', 'contact'=>'��������', 
   'rights'=>'�����', 'groups'=>'������', 'netlogon'=>'������', 'directum'=>'2Rectum', /*'login'=>'Login', 'nw'=>'Novell' */ 'mig'=>'�������');
 if(!$u or !($CFG->udn=user2dn($u))):
  $CFG->tabs=Array('no'=>'������');
 elseif(ldap_compare($CFG->h, $CFG->udn, 'objectClass', 'computer')):
  Header("Location: ../host/?".$_SERVER['QUERY_STRING']);
  exit;
 else: 
  $extraTabs=Array('ok'=>'���������', 'groupz'=>'������', 'created'=>'���������', 'unix'=>'Unix', 'mail'=>'��������');
  if($extraTabs[$CFG->params->x]):
   unset($CFG->tabs['nw']);
   $CFG->tabs[$CFG->params->x]=$extraTabs[$CFG->params->x];
   if('groupz'==$CFG->params->x)unset($CFG->tabs['groups']);
  endif;
/*
  if('ok'==$CFG->params->x) $CFG->tabs['ok']='���������';
  if('groupz'==$CFG->params->x):
   unset($CFG->tabs['nw']);
   unset($CFG->tabs['groups']);
   $CFG->tabs['groupz']='������';
  endif;
  if('created'==$CFG->params->x):
   $CFG->tabs['created']='���������';
   unset($CFG->tabs['nw']);
  endif;
  if('unix'==$CFG->params->x):
   $CFG->tabs['unix']='Unix';
   unset($CFG->tabs['nw']);
  endif;
  if('mail'==$CFG->params->x):
   $CFG->tabs['mail']='��������';
   unset($CFG->tabs['nw']);
  endif;
*/
 endif;
endif;

//if('POST'!=$_SERVER['REQUEST_METHOD'])LoadLib('2omz');

tabsBeforeBody();

$title='������������';
if($CFG->udn) $title.=': '.$CFG->params->u;
uxmHeader($title." [".tabName()."]");
?>
<H1>������������</H1>
<?
tabsHeader();
if($CFG->udn):
 LoadLib('../ufn');
 prettyUfn($CFG->udn, $CFG->params->u);
endif;
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
tabsContent();
tabsFooter();
if(function_exists('migrationInfo'))migrationInfo();
?>
</body></html>
