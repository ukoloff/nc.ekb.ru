<?
#setlocale(LC_ALL, 'ru_RU.cp1251');
dl('odbc.so');
$h=odbc_connect("driver=SQLite3;database=o.sq3", '', '');
/*
$s=odbc_prepare($h, "Insert Into X(S) Values(?)");
odbc_execute($s, Array('јзбука'));
odbc_execute($s, Array('®збука'));
odbc_execute($s, Array('≈збука'));
odbc_execute($s, Array('язбука'));
odbc_execute($s, Array('∆збука'));
odbc_execute($s, Array('азбука'));
odbc_execute($s, Array('Єзбука'));
odbc_execute($s, Array('езбука'));
odbc_execute($s, Array('€збука'));
odbc_execute($s, Array('жзбука'));
*/
$s=odbc_prepare($h, "Select *, lower(S) From X Order By S");
odbc_execute($s);
while($r=odbc_fetch_object($s)):
 print_r($r);
endwhile;

?>