<?
apache_setenv('no-gzip', '1');	# Disable gzip output

global $CFG;
LoadLib('/sort');
LoadLib('/ditobj');
$CFG->defaults->oClasses='u';
$CFG->defaults->sort='on';

$CFG->tabs=Array(
'inet'=>'��������', 
//'dial'=>'Dialup', 
'mail'=>'�����',
);

if(''==$CFG->ou):
 $CFG->tabs['spam']='����';
 $CFG->tabs['ftp']='FTP';
endif;

if($ou=trim($_REQUEST['ou'])):		// ���������� ���������� ������ ��������������
 $oufn=new ufn($ou);
 $odn=$oufn->dn();
 if($odn->Canonic() and(!$CFG->odn or $CFG->odn->isParentOf($odn))):
  $CFG->odn=$odn;
  $CFG->ou=$oufn;
  $CFG->params->ou=$ou;
 endif;
endif;

function user2obj($u)
{
 global $CFG;

 $udn=user2dn($u);
 if(!udn or $CFG->odn and !$CFG->odn->isParentOf($udn)) return;
 return getObject($udn);
}

function &obj2parent(&$obj)
{
 global $CFG;
 if(!$obj) return;
 $dn=new dn($obj->dn);
 $dn->Cut();
 if($CFG->odn and !$CFG->odn->isParentOf($dn)) return;
 $ufn=$dn->ufn();
 if(count($ufn->X)<1) return;
 $ufn=$ufn->str();
 if($x=&$CFG->ous[$ufn]) return $x;
 $x->dn=$dn->str();
 $x->ou=$ufn.chr(255);		// ����� ����� ��������� � ������ �� �����
 $x->isA='o';
 $x->t='D';
 $x->name='';	
 $CFG->ous[$ufn]=&$x;
 return $x;
}

function echoStatObject(&$x)
{
 echo "<TR Align='Right'";
 if('u'==$x->isA):
  echo '><TD Align="Left"><A hRef="./', hRef('u', $x->id), '">', htmlspecialchars($x->name), "</A>";
 else:
  $x->ou=substr($x->ou, 0, -1);
  echo ' Class=Dept><TD><A Title="���������� ������ ���� �����" hRef="./', hRef('ou', $x->ou), '">�����</A>';
 endif;
 echo '</TD><TD Align="Left">', htmlspecialchars($x->ou);
 echo '<BR /></TD>';
}

?>
