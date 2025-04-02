<?
setlocale(LC_ALL, "ru_RU.cp1251");

if(!function_exists('mssql_pconnect')) dl('mssql.so');
$MS=@mssql_pconnect('Q5', "LAN\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
mssql_select_db('OMZ');

$q=mssql_query("Select omz From Impostors Where uxm='{$CFG->u}'");
$r=mssql_fetch_array($q);
if($r)
  echo "Новая учётная запись: ", htmlspecialchars($r[0]);
else
 echo "Учётная запись при миграции не менялась (", htmlspecialchars($CFG->u), ')';

echo "<P>";

$q=mssql_query("Select * From Migration Where uxm='{$CFG->u}'");
$r=mssql_fetch_assoc($q);

if(!$r):
  echo '<Center>Сведений о миграции не найдено</Center>';
else:
 echo "Миграция проведена ", $r['Date'], " (по Гринвичу)";
endif;

?>
<P>
&raquo;
Перейти к <A hRef='/omz/me/'>учётной записи в домене OMZGLOBAL</A>
