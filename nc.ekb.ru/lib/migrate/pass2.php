<?
require('../ldap.php');
require('../ldapmod.php');
require('../mysql.php');

$q=mysql_query(<<<SQL
Select u
From phpadmin.users 
Where smbPass!='' And smbPass Is Not Null
SQL
);

while($r=mysql_fetch_object($q)):
 $u=$r->u;
 echo "$u ";
// mysql_query("Update users set Migrated='2005-02-21 16:00:00' Where u='".AddSlashes($u)."'");
endwhile;

?>
