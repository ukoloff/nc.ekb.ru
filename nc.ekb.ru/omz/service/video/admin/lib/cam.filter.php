<Small>Показать:</Small>
<Select onChange='cFilter(this)'>
<Option Value=''>Все камеры
<?
$q=mssql_query('Select * From list Where show=1');
while($r=mssql_fetch_object($q)):
  $f=join(', ', preg_split('/\D+/', $r->cameras, null, PREG_SPLIT_NO_EMPTY));
  if(!strlen($f)) continue;
  $f=mssql_fetch_row(mssql_query(
    "Select ','+Cast(id As VarChar) As '*' From cam Where id in($f) Order By id For XML Path('')"));
  $f=$f[0];
  if(!strlen($f)) continue;
  echo '<Option Value="', substr($f, 1), '">', htmlspecialchars($r->name), "\n";
endwhile;
?>
</Select>
