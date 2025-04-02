<? // Some stats to export by SNMP...

LoadLib('/dc/db/v2011.connect');

echo "x:0";

#1. Central gate - ins
$q=mssql_query("Select COUNT(*) From EVENTS, READER Where READERDESC Like 'Проходная завода % Вход %' And PanelID=MACHINE And ReaderID=DevID");
$r=mssql_fetch_array($q);
echo " gin:", $r[0];

#2. Central gate - outs
$q=mssql_query("Select COUNT(*) From EVENTS, READER Where READERDESC Like 'Проходная завода % Выход %' And PanelID=MACHINE And ReaderID=DevID");
$r=mssql_fetch_array($q);
echo " gout:", $r[0];

#3. Zekh - ins
$q=mssql_query("Select COUNT(*) From EVENTS, READER Where READERDESC Like 'Цех % Вход %' And PanelID=MACHINE And ReaderID=DevID");
$r=mssql_fetch_array($q);
echo " zin:", $r[0];

#4. Zekh - outs
$q=mssql_query("Select COUNT(*) From EVENTS, READER Where READERDESC Like 'Цех % Выход %' And PanelID=MACHINE And ReaderID=DevID");
$r=mssql_fetch_array($q);
echo " zout:", $r[0];

echo "\n";

exit;
?>
