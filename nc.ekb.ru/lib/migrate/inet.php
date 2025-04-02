<?
require('../ldap.php');
require('../ldapmod.php');
require('../mysql.php');

//ldapCheckPass('stas', '') or die('XXX');

$q=mysql_query("Select * From limits Order By limitMb");
while($r=mysql_fetch_object($q)):
 $u=$r->u;
 $d=sqlGet("Select Max(Month) From ipUse Where u='$u'");
 if(!$d)$d='-';
 if(!inGroup('#squid', $u)) continue;
 echo 
    inGroup('squid', $u)?'+':'-', " ",
    inGroup('(squid)', $u)?'+':'-', " ",
    inGroup('#squid', $u)?'+':'-', "\t",
    $r->limitMb, "\t",
    $d, "\t",
    $u, "\n";
// ldapGroupAdd(group2dn('#squid'), user2dn($u), 1);
endwhile;

?>
