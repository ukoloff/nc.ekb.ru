<?
require('../../lib/uxm.php');
LoadLib('/tabs');

$CFG->params->ou=$g=trim($_REQUEST['ou']);
if('new'==$CFG->params->x):
 $CFG->tabs=Array(''=>'', 'new'=>'�����');
else:
 $CFG->tabs=Array('list'=>'������', 'search'=>'�����', data=>'������'/*, 'login'=>'Login'*/);
// if(!$CFG->params->ou)$CFG->tabs['nw']='Netware';
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

tabsBeforeBody();

$title='�������������';
if($CFG->odn):
 if($CFG->params->ou) $title.=': '.$CFG->params->ou;
 else $title='�����';
endif;
uxmHeader($title." [".tabName()."]");
echo "<H1>", ($CFG->odn and !$CFG->params->ou)? '�����' : '�������������', "</H1>\n";
tabsHeader();
//if($CFG->odn and $CFG->params->d) echo "<H2>�������������: ", htmlspecialchars($CFG->params->d), "</H2>\n";
if($CFG->odn):
 LoadLib('../ufn');
 prettyUfn($CFG->odn);
endif;
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
tabsContent();
tabsFooter();
?>
</body></html>
