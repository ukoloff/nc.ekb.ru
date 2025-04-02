<?
require('../ldap.php');
require('../mysql.php');

$Depts=Array(
'ОГМ'=>'ОГМех',
'Огмех'=>'ОГМех',
'ФИНЭКС'=>'Внешние/ФИНЭКС',
'Дирекция dialup'=>'Дирекция',
);

$q=mysql_query(<<<SQL
Select users.u, users.Dept, users.realm, users.Contact
From users Left Join groups On users.u=groups.u And groups.g in('System')
Where groups.u Is Null
SQL
);

ldapCheckPass('###', '###') or die('XXX');

while($r=mysql_fetch_object($q)):
 $u=$r->u;
 if(user2dn($u)) continue;
 $SaveDept=$Dept=$r->Dept;
 if(sqlInGroup('ExtU', $u)) $Dept="Внешние/$Dept";
 if(sqlInGroup('Ext', $u)):
  if($Dept=='дом') $Dept='';
  if($Dept)$Dept="/$Dept";
  $Dept="Внешние/Модем$Dept";
 endif;
 if(preg_match('/цех\s*(\d+)/i', $Dept, $match)):
   $x=trim(preg_replace('/цех\s*(\d+)/i', '', $Dept));
   $Dept="Цех/$match[1]";
   if($x) $Dept.="/$x";
 endif;
 $Dept=preg_replace("/почта$/", '', $Dept);
 $Dept=preg_replace('(/$)', '', $Dept);
 if($Depts[$Dept]) $Dept=$Depts[$Dept];
 if(!$Dept) $Dept='Разное';

 $ou=new ufn($Dept);
 $dn=$ou->dn();
 if(!$dn->Canonic()):
  echo "Creating[$u]: $Dept\n";
  $pou=new ufn('/');
  for($i=0; $i<count($ou->X); $i++):
   $pou->X[$i]=$ou->X[$i];
   $pdn=$pou->dn();
   if($pdn->Canonic()) continue;
   ldap_add($CFG->h, $pdn->str(), 
     Array('description'=>utf8('% Сгенерирован при миграции'), 'objectClass'=>'organizationalUnit'));
  endfor;
 endif;

 $cn=$r->realm;
 while(true):
  $qq=ldap_search($CFG->h, $CFG->Base, "(&(objectClass=User)(cn=".str2ldap($cn)."))", Array('1.1'));
  $n=ldap_count_entries($CFG->h, $qq);
  ldap_free_result($qq);
  if($n<=0) break;
  $cn=preg_replace('|\s*\((\d+)\)\s*$|', '', $cn, $matches);
  $i=1+$matches[1];
  $cn="$cn ($i)";
 endwhile;

 $udn=$dn;
 $udn->Paste('cn', utf8($cn));
 echo "Creating $u...\n";
 ldap_add($CFG->h, $udn->str(), Array('objectClass'=>'User', 'sAMAccountName'=>utf8($u), 
    'info'=>utf8("% $SaveDept\n".$r->Contact)));
 
endwhile;


function sqlInGroup($g, $u)
{
 $u=AddSlashes($u);
 $g=AddSlashes($g);
 $q=mysql_query("Select * From groups Where u='$u' and g='$g'");
 return mysql_num_rows($q)>=1;
}

?>
