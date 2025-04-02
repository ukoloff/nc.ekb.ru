<?
global $CFG;

$n=0+$_GET['n'];
$q=sqlite3_query($CFG->db, "Select Host From Switch Where No=$n");
$q=sqlite3_fetch($q);
$q=$q[0];
//header("Content-Type: text/html");
header("Content-disposition: attachment; filename=\"$q.xls\"");
?>
<html><head><title><?=htmlspecialchars($q)?></title></head><body>
<Table Border>
<TR><TH>Port</TH><TH>MAC</TH><TH>IP</TH><TH>Switch</TH><TH>Host</TH>
</TR>
<?

$q=sqlite3_query($CFG->db, <<<SQL
Select Port, MACs.MAC, IPs.IP, Switch.Host As Sw
From Comm Left Join MACs On Comm.MAC=MACs.No
    Left Join ARP On Comm.MAC=ARP.MAC Left Join IPs On ARP.IP=IPs.No
    Left Join SwInfo On IPs.No=SwInfo.IP Left Join Switch On SwInfo.No=Switch.No
Where Sw=$n
Order By 1, 4 Desc
SQL
);
while($r=sqlite3_fetch_array($q)):
  $IP=AddSlashes($r['IP']);
  $m=mysql_query("Select Distinct Computer From uxmJournal.netLog Where IP='{$IP}' And Time>SubDate(Now(), INTERVAL 1 MONTH )");
  $S='';
  while($mr=mysql_fetch_row($m)):
   if($S)$S.="\n";
   $S.=$mr[0];
  endwhile;
  if(!$S):
   $m=mysql_query("Select Distinct host from ip2host Where Month=date_format(Now(), '%Y%m') And ip='{$IP}'");
   while($mr=mysql_fetch_row($m)):
    if($S)$S.="\n";
    $S.=$mr[0];
   endwhile;
  endif;
  echo "<TR><TD>", htmlspecialchars($r['Port']), 
    "<BR /></TD><TD>", htmlspecialchars($r['MAC']),
    "<BR /></TD><TD>", htmlspecialchars($r['IP']),
    "<BR /></TD><TD>", htmlspecialchars($r['Sw']),
    "<BR /></TD><TD>", htmlspecialchars($S),
    "<BR /></TD></TR>";
endwhile;
?>
</Table></body></html>
<?
exit;
?>
