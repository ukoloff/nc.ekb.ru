<?
require('../ldap.php');
require('../ldapmod.php');
require('../mysql.php');

$q=mysql_query(<<<SQL
Select users.u, users.pass
From users 
Where pass not in('*', '#', '')
SQL
);

while($r=mysql_fetch_object($q)):
 echo $r->u, ':', $r->pass, ":\n";
endwhile;

?>
