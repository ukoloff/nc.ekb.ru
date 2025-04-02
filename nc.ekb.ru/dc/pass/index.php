<?
require('../../lib/uxm.php');
LoadLib('/ldapmod');

uxmHeader('Миграция паролей');
?>
<H1>Миграция паролей</H1>

<H3>Те, кто ввёл свой пароль</H3>
<?
$q=mysql_query(<<<SQL
Select users.u, users.smbPass
From users 
Where smbPass!='' And Migrated Is Null
SQL
);

while($r=mysql_fetch_object($q)):
 $u=$r->u;
 $p=base64_decode($r->smbPass);
 if(!$p) continue;
 $udn=user2dn($u);
 if(!$udn) continue;

 echo "<LI>", htmlspecialchars($u), "\n";
 ldapChangePass($u, $p);
 mysql_query("Update users set savePass=pass, pass='#', smbPass='', Migrated=Now() Where u='".AddSlashes($u)."'");
endwhile;

echo "<H3>Те, кого rip-нул John</H3>\n";
$f=fopen("/var/tmp/john-1.6/run/john.pot", "r");
if(!$f) exit;
while(!feof($f)):
 list($hash, $pass)=explode(':', trim(fgets($f)));
 $q=mysql_query("Select u from users Where Migrated Is Null And pass='".AddSlashes($hash)."'");
 while($r=mysql_fetch_object($q)):
  if(!sqlCheckPass($r->u, $pass)) continue;
  echo "<LI>", htmlspecialchars($r->u), "\n";
 endwhile;
endwhile;
echo "<H3>Те, кто ещё остались</H3>\n";
//fclose($f);

$q=mysql_query(<<<SQL
Select u, realm
From users 
Where Migrated Is Null And pass Not in('#', '*')
SQL
);

//$f=fopen('rest.lst', 'w');
while($r=mysql_fetch_object($q)):
 $dn=user2dn($u=$r->u);
 if(!$dn) continue;
 $e=getEntry($dn, 'useraccountcontrol');
 $e=$e[$e[0]][0];
 if($e&uac_ACCOUNTDISABLE) continue;
 echo "<LI><B>", htmlspecialchars($u), "</B>\n", htmlspecialchars($r->realm), "\n";
// mysql_query("Update users set Migrated='2005-02-21 16:00:00' Where u='".AddSlashes($u)."'");
endwhile;
//fclose($f);

?>
<HR />
</body></html>
