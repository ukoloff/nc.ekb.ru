<?
#setlocale(LC_ALL, 'ru_RU.cp1251');
dl('odbc.so');
$h=odbc_connect("driver=SQLite3;database=o.sq3", '', '');
/*
$s=odbc_prepare($h, "Insert Into X(S) Values(?)");
odbc_execute($s, Array('������'));
odbc_execute($s, Array('������'));
odbc_execute($s, Array('������'));
odbc_execute($s, Array('������'));
odbc_execute($s, Array('������'));
odbc_execute($s, Array('������'));
odbc_execute($s, Array('������'));
odbc_execute($s, Array('������'));
odbc_execute($s, Array('������'));
odbc_execute($s, Array('������'));
*/
$s=odbc_prepare($h, "Select *, lower(S) From X Order By S");
odbc_execute($s);
while($r=odbc_fetch_object($s)):
 print_r($r);
endwhile;

?>