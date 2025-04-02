<?
ini_set("display_errors", 1);

require("../../../lib/uxm.php");

uxmHeader('Двигаем компьютеры');
?>
<H1>Двигаем компьютеры</H1>

<?
$z=new UFN('/Компьютеры/Кошки');
$z=$z->dn();
$to=$z->Canonic();

if(!function_exists('sqlite3_open')) dl('sqlite3.so');

$Path=dirname(__FILE__)."/data/drctm.db";
$z=sqlite3_open($Path);

$q=sqlite3_query($z, "Select Distinct Host From Log Order By 1");
while($r=sqlite3_fetch($q)):
 echo "<LI>", $x=$r[0];

 $w=ldap_search($CFG->h, $CFG->Base, "(&(objectClass=computer)(cn=$x)(!(operatingSystem=*Server*)))");
 if(1!=ldap_count_entries($CFG->h, $w)):
  echo "--";
  continue;
 endif;
 $dn=ldap_get_dn($CFG->h, ldap_first_entry($CFG->h, $w));
 ldap_free_result($w);
 $d=new DN($dn);
 $d->Cut();
 if($d->Canonic()==$to):
  echo " @";
  continue;
 endif; 
 echo " ", utf2html($dn);
 ldap_rename($CFG->h, $dn, "cn=$x", $to, true);
endwhile;

?>

</body></html>
