<? 
ini_set("mssql.datetimeconvert", 0);

dump('Камеры', 'cam', 'pass');
dump('Списки камер', 'list');
//dump('Пользователи', 'user', 'hash');
dump('Учётки', 'login');
dump('Предпочтения', 'userIni');
dump('Модели камер', 'vendors');
dump('Сессии', 'Auth');

function dump($H, $Tab, $Fld='')
{
 echo "<H2>$H</H2>";
 $q=mssql_query("Select * From [".$Tab."]");
 while($r=mssql_fetch_assoc($q))
 {
  unset($r[$Fld]);
  if(!$f):
   echo "<Table Border CellSpacing='0' Width='100%'><TR Class='tHeader'>";
   foreach($r as $k=>$v):
    $f[]=$k;
    echo "<TH>", htmlspecialchars($k), "<BR /></TH>\n";
   endforeach;
   echo "</TR>";
  endif;
  echo "<TR>";
  foreach($f as $k)
   echo "<TD>", htmlspecialchars($r[$k]), "<BR /></TD>\n";
  echo "</TR>";
 }
 if($f) echo "</Table>\n";
}
?>
