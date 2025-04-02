<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'><TH>Имя</TH>
<TH>AS</TH>
<TH>IP</TH>
<TH>BGP</TH>
<TH>State</TH>
<TH>Default</TH>
</TR>
<?
$me=tGet('.1.3.6.1.2.1.15', Array(locAS=>2, id=>4)); $me=$me[0];
print "<TR><TD Align='Center'>Уралхиммаш</TD><TD>$me[locAS]<BR /></TD><TD>$me[id]<BR /></TD><TD>-</TD><TD><BR /></TD><TD>-</TD></TR>\n";
$Peers=tGet('.1.3.6.1.2.1.15.3.1', Array(id=>1, State=>2, v=>4, locIP=>5, remIP=>7, remAS=>9));
$Attrs=tGet('.1.3.6.1.2.1.15.6.1', Array(IP=>1, Best=>13));
$ints=tGet('.1.3.6.1.2.1.2.2.1', Array(id=>1, Descr=>2, MTU=>4, Speed=>5, State=>8, remAS=>9));
$intz=tGet('.1.3.6.1.2.1.31.1.1.1', Array(Name=>1, Alias=>18));
$ips=tGet('.1.3.6.1.2.1.4.20.1', Array(IP=>1, port=>2, mask=>3));

foreach($Attrs as $z) $Attrs[$z[IP]]=$z;
foreach($ips as $z) $ips[$z[IP]]=$z;

foreach($Peers As $p):
 $port=$ips[$p[locIP]][port]-1;
 $n=$intz[$port][Alias];
 if(!$n) $n=$intz[$port][Name];
 if(!$n) $n=$ints[$port][Desc];
 echo "<TR><TD>$n<BR /></TD><TD>$p[remAS]<BR /></TD><TD>$p[remIP]<BR /></TD><TD>$p[v]<BR /></TD><TD>", 6==$p[State]?'OK':'BAD', "</TD><TD>", 2==$Attrs[$p[remIP]][Best]?'*':'', "<BR /></TD></TR>\n";
endforeach;

function tGet($Root, $Children)
{
 global $CFG;
 foreach($Children as $k=>$v)
  foreach(snmpwalk($CFG->SNMP->host, $CFG->SNMP->community, $Root.'.'.$v) as $p=>$q)
   $R[$p][$k]=$q;
 return $R;
}

?>
</Table>
<P />
<Small>
&raquo;
Информация получена в реальном времени с BGP-маршрутизатора
</Small>
