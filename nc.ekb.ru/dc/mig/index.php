<?
require('../../lib/uxm.php');
LoadLib('/pages');
LoadLib('/sort');

$CFG->sort=Array(
    't'=>Array('field'=>'At', 'name'=>'', 'rev'=>1),
    'u'=>Array('field'=>'u', 'name'=>'Юзер'),
    'h'=>Array('field'=>'host', 'name'=>'Компьютер'),
    'r'=>Array('field'=>'Room', 'name'=>'Комната', 'isTail'=>1),
    'b'=>Array('field'=>'Building', 'name'=>'Здание'),
    'p'=>Array('field'=>'Phone', 'name'=>'Телефон'),
    'n'=>Array('field'=>'Notes', 'name'=>'Заметки'),
);
$CFG->defaults->sort='t';

uxmHeader('Миграция');
?>
<H1>Миграция</H1>

<?
$q=mysql_query("Select * From migHost".sqlOrderBy());
$N=mysql_num_rows($q);
if($lineNo=pageStart($N))
  mysql_data_seek($q, $lineNo);
PageNavigator();
sortedHeader('uhrbpn');
while($r=mysql_fetch_object($q)):
 echo '<TR><TD>';
 if($u=$r->u)
  echo '<A hRef="/dc/user/', hRef('u', $u), '">', htmlspecialchars($u), "</A>";
 echo '<BR /></TD><TD><A hRef="host/', hRef('n', $r->N), '">', htmlspecialchars($r->host), "<BR /></TD>\n";;
 $isTale=false;
 foreach($CFG->sort as $k=>$v):
  if(!$isTale and !$v['isTail']) continue;
  $isTale=true;
  $v=$v['field'];
  echo "<TD>", htmlspecialchars($r->$v), "<BR /></TD>\n";
 endforeach;
 echo "</TR>\n";
 if(isLastLine($lineNo++)) break;
endwhile;
sortedFooter();
PageNavigator();

?>
</body></html>

