<?
putenv('MIBDIRS=/dev/null');
if(!function_exists('snmpget')) dl('snmp.so');
snmp_set_quick_print(1);

function snmpInfo($host, $fast=false)
{
$OIDs=Array(
 Descr=>'1.3.6.1.2.1.1.1',
 ObjectId=>'1.3.6.1.2.1.1.2',
 UpTime=>'1.3.6.1.2.1.1.3',
 Contact=>'1.3.6.1.2.1.1.4',
 Name=>'1.3.6.1.2.1.1.5',
 Location=>'1.3.6.1.2.1.1.6',
 Services=>'1.3.6.1.2.1.1.7',
 ifNumber=>'1.3.6.1.2.1.2.1');
 foreach($OIDs as $k=>$v):
  $r=@snmpget($host, 'public', $v.'.0', 10);
  if(!$X and !strlen($r)) return;
  $X->$k=$r;
  if($fast)break;
 endforeach;
 return $X;
}

// ARP->1.3.6.1.2.1.4.22.1.2
// MAC/Port->1.3.6.1.2.1.17.4.3.1.2
// LLDP->1.0.8802.1.1.2.1.4.1
?>
