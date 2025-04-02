<?
function ARP($ip)
{
 $f=fopen('/proc/net/arp', 'r');
 while(!feof($f)):
  $X=preg_split('/\s+/', fgets($f));
  if($X[0]==$ip) return strtolower($X[3]);
 endwhile;
 flose($f);
}
?>
