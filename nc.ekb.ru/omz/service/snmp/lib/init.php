<? // Some stats to export by SNMP...

#1. MySQL Requests
$q=mysql_query("Show Global Status Like 'Questions'");
$r=mysql_fetch_row($q);
echo $r[1], "\n";

#2. MySQL Sessions
$q=mysql_query("Show Global Status Like 'Connections'");
$r=mysql_fetch_row($q);
echo $r[1], "\n";

#3. Domain logons
$q=mysql_query("Select Count(*) From uxmJournal.netLog");
$r=mysql_fetch_row($q);
echo $r[0], "\n";

#4. OpenVPN connects
$q=mysql_query("Select Count(*) From uxmJournal.OpenVPN Where Op='+'");
$r=mysql_fetch_row($q);
echo $r[0], "\n";

#5. OpenVPN disconnects
$q=mysql_query("Select Count(*) From uxmJournal.OpenVPN Where Op='-'");
$r=mysql_fetch_row($q);
echo $r[0], "\n";

exit;
?>
