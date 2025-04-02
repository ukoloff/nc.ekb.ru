<?
require('../ldap.php');
require('../ldapmod.php');
require('../mysql.php');

$Depts=Array(
'ОГМ'=>'ОГМех',
'Огмех'=>'ОГМех',
'ФИНЭКС'=>'Внешние/ФИНЭКС',
'Дирекция dialup'=>'Дирекция',
);

$q=mysql_query(<<<SQL
Select users.u
From users 
SQL
);

ldapCheckPass('###', '###') or die('XXX');

while($r=mysql_fetch_object($q)):
 $u=$r->u;
 $udn=user2dn($u);
 if(!$udn) continue;
/*
 $e=getEntry($udn, 'userAccountControl');
 $uac=$e[$e[0]][0];
 if(!sqlInGroup('-Mail', $u)):
  echo "!!!\n";
  ldapModify($udn, Array('userAccountControl'=>$uac&(~uac_ACCOUNTDISABLE), 'msSFU30NisDomain'=>'*'));
 endif;
 echo "$u\t$uac\n";
*/ 
/*
 if(sqlInGroup('Ext', $u))
  ldapGroupAdd(group2dn('#dialupGold'), $udn);
 elseif(sqlInGroup('dial', $u))
  ldapGroupAdd(group2dn('#dialup'), $udn);
*/
 if(sqlInGroup('Xsquid', $u)):
  ldapGroupAdd(group2dn('(squid)'), $udn);
  ldapGroupAdd(group2dn('squid'), $udn);
 endif;

 if(sqlInGroup('squid', $u)):
  ldapGroupAdd(group2dn('squid'), $udn);
 endif;
 if(sqlInGroup('.squid', $u)):
  ldapGroupAdd(group2dn('#squid'), $udn);
 endif;

endwhile;


function sqlInGroup($g, $u)
{
 $u=AddSlashes($u);
 $g=AddSlashes($g);
 $q=mysql_query("Select * From groups Where u='$u' and g='$g'");
 return mysql_num_rows($q)>=1;
}

?>
