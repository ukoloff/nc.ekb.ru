<?
putenv('MIBDIRS=/dev/null');
snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
snmp_set_valueretrieval(SNMP_VALUE_PLAIN);
//snmp_set_valueretrieval(SNMP_VALUE_LIBRARY);

$zero = str_repeat('0', 12);

$sep = ';';
$mime = 'text/csv';
$ext = 'csv';
switch($mode = strtolower($_GET['as'][0])):
  default: 
    $n = 0;
    $mode = 'j';
    $mime = 'application/json';
    $ext = 'json';
    break;
  case 't': 
    $sep = "\t";
    $mime = 'text/tab-separated-values';
    $ext = 'tsv';
  case 'c':
endswitch;

Header("Content-Type: $mime");
Header('Content-Disposition: attachment; filename="arp-'.strftime('%Y-%m-%dT%H-%M-%S').".$ext\"");

switch($mode):
  case 'j':
    echo "[";
    break;
  case 't': 
  case 'c':
    echo "ip${sep}mac\n";
endswitch;

foreach(snmp2_real_walk('10.33.10.1', 'public', '1.3.6.1.2.1.4.22.1.2') as $k => $v):
  $mac = bin2hex($v);
  if ($mac == $zero)
    continue;
  $ip = implode('.', array_slice(explode('.', $k), -4));
  switch ($mode):
    case 'j':
      if ($n++) echo ",\n\t";
      echo "{\"ip\":\t\"$ip\",\t\"mac\":\t\"$mac\"}";
      break;
    case 't': 
    case 'c': 
      echo "$ip$sep$mac\n";
  endswitch;
endforeach;

switch($mode):
  case 'j':
    echo "]";
endswitch;

exit();
?>
