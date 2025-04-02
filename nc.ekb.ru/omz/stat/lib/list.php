<?
$CFG->params->list=trim($_REQUEST['list']);

$CFG->tabs=Array(
 'hello'=>'*',
 'inet'=>'Интернет', 
//'dial'=>'Dialup', 
//'mail'=>'Почта',
);

if(''!=$CFG->params->list):		// Ограничить статистику только подразделением
 $oufn=new ufn($CFG->params->list);
 $odn=$oufn->dn();
 if($odn->Canonic()):
  $CFG->odn=$odn;
  $CFG->ou=$oufn;
 endif;
endif;

/*
if($CFG->odn):	// Проверка на OU...
endif;
*/

if($CFG->Who>1 and !$CFG->odn):
// $CFG->tabs['spam']='Спам';
 $CFG->tabs+=Array(/*ftp=>'FTP',*/sucks=>'Враги', nod32=>'Nod32', rdp=>'RDP@WWW', ovpn=>'OpenVPN');

 if('stas'==$CFG->u)
   $CFG->tabs+=Array(tsg=>'Шлюз RDP', sign=>'ЭЦП');
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
 $x->ou=$ufn.chr(255);		// Чтобы стоял последним в списке по имени
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
  echo '><TD Align="Left"><A hRef="./', hRef('u', strtolower($x->id), 'list'), '">', htmlspecialchars($x->name), "</A>";
 else:
  $x->ou=substr($x->ou, 0, -1);
  echo ' Class=Dept><TD><A Title="Посмотреть только этот отдел" x-hRef="./', hRef('list', $x->ou), '">Итого</A>';
 endif;
 echo '</TD><TD Align="Left">', htmlspecialchars($x->ou);
 echo '<BR /></TD>';
}

?>
