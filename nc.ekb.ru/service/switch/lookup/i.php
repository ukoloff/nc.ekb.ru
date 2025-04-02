<?
global $CFG;
require("../../../lib/uxm.php");

putenv('MIBDIRS=/dev/null');
if(!function_exists('snmpget')) dl('snmp.so');
snmp_set_quick_print(1);

uxmHeader('Коммутация');
?>
<H1>Коммутация</H1>
<?
$S=explode(" ","server ltk1 ltk2 ltk3 ltk4 sko x3 adsl bo x40 x02");
$OIDs=Array(
 Descr=>'1.3.6.1.2.1.1.1.0',
 Contact=>'1.3.6.1.2.1.1.4.0',
 Name=>'1.3.6.1.2.1.1.5.0',
 Location=>'1.3.6.1.2.1.1.6.0');

foreach($S as $z):
 $host=$z.'.switch.uxm';

// $D=snmpget($host, 'public', $OIDs['Descr']);
// $L=snmpget($host, 'public', $OIDs['Location']);
 echo "<LI>", $host, "[", @snmpget($host, 'public', '1.3.6.1.2.1.17.4.3.1.2.0.17.91.168.128.36', 10), "]: $D @ $L\n";
endforeach;
?>

</body></html>

