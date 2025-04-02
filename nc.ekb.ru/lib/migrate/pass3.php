<?
require('../ldap.php');
require('../ldapmod.php');
require('../mysql.php');

$q=mysql_query(<<<SQL
Select u, realm
From users 
Where Migrated Is Null And pass Not in('#', '*')
SQL
);

while($r=mysql_fetch_object($q)):
 $dn=user2dn($u=$r->u);
 if(!$dn) continue;
 $e=getEntry($dn, 'useraccountcontrol');
 $e=$e[$e[0]][0];
 if($e&uac_ACCOUNTDISABLE) continue;
 echo "$u\t", $r->realm, "\n";
// mysql_query("Update users set Migrated='2005-02-21 16:00:00' Where u='".AddSlashes($u)."'");
endwhile;

?>
