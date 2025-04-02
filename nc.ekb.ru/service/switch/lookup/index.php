<?
apache_setenv('no-gzip', '1');	# Disable gzip output

global $CFG;
require("../../../lib/uxm.php");

LoadLib('arp');

function x02($s)
{
 while(strlen($s)<2) $s='0'.$s;
 return $s;
}

$q=trim($_REQUEST['q']);
if(preg_match('/^[[:xdigit:]]{12}$/', $q)):	// MAC
  $CFG->MAC=$q=substr(chunk_split($q, 2, ':'), 0, -1);
elseif(preg_match('/^([[:xdigit:]]{1,2}[-:.]){6}$/', $q.":")):	// Another MAC
  $CFG->MAC=$q=join(':', array_map(x02, preg_split('/[-:.]/', $q)));
elseif(preg_match('/^(\d+)\.(\d+)$/',$q, $m) and $m[1]<256 and $m[2]<256):
  $q='192.168.'.$q;
endif;

#if(!function_exists('snmpget')) dl('snmp.so');
#snmp_set_quick_print(1);

uxmHeader('Коммутация');
?>
<H1>Коммутация</H1>
<Form Action='./' x-Method='POST'>
<Small>Введите имя хоста, IP-адрес (можно без 192.168.) или MAC-адрес для поиска:</Small><BR />
<Input Name='q' Value="<?=htmlspecialchars($q)?>"/>
<Input Type='Submit' Value=' Поиск! ' />
</Form>
<?
$CFG->entry->q=$q;
if(!$CFG->MAC and strlen($q)) LoadLib('resolve');
else LoadLib('focus');

if($CFG->MAC) LoadLib('walk');
?>
</body></html>
