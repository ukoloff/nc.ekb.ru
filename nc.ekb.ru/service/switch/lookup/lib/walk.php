<H2>WALK...</H2>
<?
$Root='server.switch.uxm';
flush();
global $CFG;
LoadLib('snmp');

$q=sqlite3_query($CFG->db, "Select '$Root' Union Select Host From Switch");
$CFG->Sx=Array();
while($r=sqlite3_fetch($q)):
  unset($X);
  $X->Host=$r[0];
  $X->IP=gethostbynamel($X->Host);
  if(!$X->IP) continue;
  $X->SNMP=snmpInfo($X->IP=$X->IP[0], true);
  if(!$X->SNMP) continue;
  $X->MAC=ARP($X->IP);
  $CFG->Sx[]=$X;
endwhile;
sqlite3_query_close($q);

function findPort($host, $MAC)
{
 return @snmpget($host, 'public', '1.3.6.1.2.1.17.4.3.1.2.'.join('.', array_map(hexdec, explode(':', $MAC))), 10);
}

echo "server.switch.uxm[", $myPort=findPort('server.switch.uxm', $CFG->MAC), "]";

foreach($CFG->Sx as $z):
 if(findPort('server.switch.uxm', $z->MAC)!=$myPort) continue;
// echo ", ", $z->Host, '[', $thisPort=findPort($z->IP, $CFG->MAC), ']';
 $thisPort=findPort($z->IP, $CFG->MAC);
 $Found=1;
 foreach($CFG->Sx as $zz)
   if($zz->MAC!=$CFG->MAC and findPort($z->IP, $zz->MAC)==$thisPort): $Found=0; break; endif;
 if(!$Found) continue;
 echo ", ", $z->Host, '[', $thisPort, ']';
 break;
endforeach;

?>
