<?
setlocale(LC_ALL, "ru_RU.cp1251");

if(!function_exists('mssql_pconnect')) dl('mssql.so');
$MS=@mssql_pconnect('Q5', $CFG->AD->Domain."\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
mssql_select_db('OMZ');

$q=mssql_query("Select uxm From Impostors Where omz='{$CFG->u}'");
$r=mssql_fetch_array($q);
if($r)
  echo "������ ������� ������: ", htmlspecialchars($r[0]);
else
 echo "������� ������ ��� �������� �� �������� (", htmlspecialchars($CFG->u), ')';

echo "<P>";

$q=mssql_query("Select * From Migration Where omz='{$CFG->u}'");
$r=mssql_fetch_assoc($q);

if(!$r):
  echo '<Center>�������� � �������� �� �������</Center>';
else:
 echo "�������� ��������� ", $r['Date'], " (�� ��������)";
endif;

?>
<P>
&raquo;
������� � <A hRef='/me/'>������� ������ � ������ LAN</A>
