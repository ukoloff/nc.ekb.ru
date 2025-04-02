<?
$f=popen(dirname(__FILE__).'/start', 'w');
foreach($CFG->L2 as $host=>$ip)
  fwrite($f, "$ip\t$host\n");
pclose($f);

Header('Location: ./');
exit;
?>